<?php

namespace App\Http\Controllers;

use App\Models\Analysis;
use App\Models\Setting;
use App\Models\Visit;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AnalysisController extends Controller
{

    public function store()
    {
        $step2Arr = [];
        $tab = request('tab');
        if($tab=='create') {
            /////////////////////////////////////
            // 차수
            if(request('kt_select2_5')) {
                $waves = request('kt_select2_5');
                foreach ($waves as $wave) {
                    Analysis::create(['type'=>'wave', 'value'=> (int)$wave]);
                }

            }

            /////////////////////////////////////
            // 가구용 원자료 변수
            if(request('kt_select2_3')) {
                $hs = request('kt_select2_3');
                foreach ($hs as $h) {
                    Analysis::create(['type'=>'h', 'value'=> $h]);
                }
                $step2Arr[] = ['type' => 'step2', 'value' => 'h'];
            }

            /////////////////////////////////////
            // 개인용 원자료 변수
            if(request('kt_select2_4')) {
                $ps = request('kt_select2_4');
                foreach ($ps as $p) {
                    Analysis::create(['type'=>'p', 'value'=> $p]);
                }
                $step2Arr[] = ['type' => 'step2', 'value' => 'p'];
            }

            /////////////////////////////////////
            // 가구용 Klips 원자료 변수 추가
            if(request('add_h')) {
                $add_hs = explode(' ', request('add_h'));
                foreach ($add_hs as $add_h) {
                    Analysis::create(['type'=>'h_src', 'value'=> $add_h]);
                }
                $step2Arr[] = ['type' => 'step2', 'value' => 'src']; // 원자료 변수 추가
            }

            /////////////////////////////////////
            // 개인용 Klips 원자료 변수 추가
            if(request('add_p')) {
                $add_ps = explode(' ', request('add_p'));
                foreach ($add_ps as $add_p) {
                    Analysis::create(['type'=>'p_src', 'value'=> $add_p]);
                }
                $step2Arr[] = ['type' => 'step2', 'value' => 'src']; // 원자료 변수 추가
            }


            /////////////////////////////////////
            //  부가조사 차수
            if(request('a_wave')) {
                $a_waves = request('a_wave');
                $add_as = request('add_a');
                $rtnStr='';
                foreach ([0,1,2] as $i) {
                    if (isset($a_waves[$i]) && isset($add_as[$i])) {
                        $arAs = explode(' ', $add_as[$i]);
                        foreach ($arAs as $a) {
                            $rtnStr = $a_waves[$i]['label'].'_' . $a;
                            Analysis::create(['type' => 'wave_a', 'value' => $rtnStr]);
                        }
                    }
                }
                /*foreach ($a_waves as $a_wave) {
                    Analysis::create(['type'=>'wave_a', 'value'=> (int)$a_wave['value']]);
                }*/

                $step2Arr[] = ['type' => 'step2', 'value' => 'src_a']; // 원자료 부가조사
            }

            /////////////////////////////////////
            // 부가 조사 차수 변수
            if(request('add_a')) {
                $add_as = request('add_a');
                foreach ($add_as as $add_a) {
                    Analysis::create(['type'=>'var_a', 'value'=> $add_a]);
                }

            }

            /////////////////////////////////////
            // 파일 저장 타입
            if(request('filesave')) {
                $fileSaves = request('filesave');
                foreach ($fileSaves as $fileSave) {
                    Analysis::create(['type'=>'file', 'value'=> $fileSave]);
                }
            }

            /////////////////////////////////////
            // step2 추이초사
            if(count($step2Arr) > 0) {
                foreach ($step2Arr as $step2Arr_item) {
                    Analysis::create($step2Arr_item);
                }
                //
            }

        }


        /////////////////////////////////////// 2번째 탭 /////////////////////////////////////

        /////////////////////////////////////
        // 차수
        else if($tab=='search') {
            if(request('kt_select2_5')) {
                $waves = request('kt_select2_5');
                foreach ($waves as $wave) {
                    Analysis::create(['type'=>'s_wave', 'value'=> (int)$wave]);
                }
            }

            if(request('word')) {
                $word = request('word');
                Analysis::create(['type' => 's_word', 'value' => $word]);
            }

            if(request('hp')) {
                $hp = request('hp');
                Analysis::create(['type' => 's_type', 'value' => $hp]);
            }
        }




        //dump(request()->all());
    }

    public function index($type)
    {
        /*
         * 기간타입으로 쿼리 생성
         * */
        $qPeriod = $this->makePeriod($type);
        $started_atC = $qPeriod['started_atC'];
        $ended_atC = $qPeriod['ended_atC'];
        $dFormat =  $qPeriod['date_format'];

        /*
         * type별 쿼리 생성
         * wave(차수), wave_a(부가차수)
         * */
        //$q = $this->makeQeuryByType($type) . $dFormat;

        $r = Analysis::select(DB::raw('value, count(*) as cnt '))->where('type' ,$type)
            ->whereBetween('created_at', [$started_atC->toDateString(),$ended_atC->format('Y-m-d')." 23:59:59" ])
            ->groupby('value')
            ->when(in_array($type, ['wave', 'wave_a', 's_wave']), function ($query) {
                return $query->orderby(DB::raw('cast(value  as decimal)'));
            })
            ->get();

        $r = $this->chgValueToLb($type, $r);

        /* 원차트 */
        if(in_array($type, ['file', 'step2','s_type'])) {
            $chartjs = app()->chartjs
                ->name('lineChartTest')
                ->type('doughnut')
                ->size(['width' => 800, 'height' => 200])
                ->labels($r->pluck('value')->toArray())
                ->datasets([
                    [
                        "label" => "검색횟수",
                        'backgroundColor' => ['#FF6384', '#36A2EB','#FFCD56', '#4BC0C0'],

                        'data' => $r->pluck('cnt')->toArray(),
                    ],
                ])->optionsRaw("{
                    legend: {
                        display: true,
                        position:'bottom',
                    }
                 }");
        }
        else {
            //변수추가 가구용, 변수추가 개인용, 부가조사 변수추가 x, y축 변경
            if(in_array($type, ['h_src', 'p_src', 'var_a', 'wave_a', 'h', 'p', 's_word'])) {
                $chartjs = app()->chartjs
                    ->name('lineChartTest')
                    ->type('horizontalBar')
                    ->size(['width' => 800, 'height' => $r->pluck('value')->count()>20?$r->pluck('value')->count()*10:300])
                    ->labels($r->pluck('value')->toArray())
                    ->datasets([
                        [
                            "label" => "검색횟수",
                            'backgroundColor' => "rgba(242, 191, 24, 0.8)",
                            'borderColor' => "rgba(133, 171, 158, 0.7)",
                            "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                            "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                            "pointHoverBackgroundColor" => "#fff",
                            "pointHoverBorderColor" => "rgba(220,220,220,1)",
                            'data' => $r->pluck('cnt')->toArray(),
                            'barPercentage'=> 0.7,
                            /*
                            'barThickness'=> 8,
                            'maxBarThickness'=> 8,
                            'minBarLength'=> 20,*/
                        ],
                    ])->optionsRaw("{
                    indexAxis: 'y',
                    legend: {
                        display: true,
                        position:'bottom',
                    }
                 }");
            }
            else {
                $chartjs = app()->chartjs
                    ->name('lineChartTest')
                    ->type('line')
                    ->size(['width' => 800, 'height' => 300])
                    ->labels($r->pluck('value')->toArray())
                    ->datasets([
                        [
                            "label" => "검색횟수",
                            'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                            'borderColor' => "rgba(38, 185, 154, 0.7)",
                            "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                            "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                            "pointHoverBackgroundColor" => "#fff",
                            "pointHoverBorderColor" => "rgba(220,220,220,1)",
                            'data' => $r->pluck('cnt')->toArray(),
                        ],
                    ])->optionsRaw("{
                    legend: {
                        display: true,
                        position:'bottom',
                    }
                 }");
            }

        }

        if (request('type') === 'csv') {
            $now = (new \Carbon\Carbon())->format("ymd");
            $filename = "analysis_{$type}_{$now}.csv";

            return response()->stream(function () use($filename, $r, $type) {
                $handle = fopen('php://output', 'w+');

                fputcsv($handle, [$this->ic('검색기간'), ]);
                fputcsv($handle, [$this->ic('시작일'), request('started_at'), $this->ic('종료일'), request('ended_at')]);
                fputcsv($handle, []);

                if($type=='wave') {
                    fputcsv($handle, [$this->ic('차수'),$this->ic('합계')]);
                }
                else if($type=='h') {
                    fputcsv($handle, [$this->ic('가구용 가공변수'),$this->ic('합계')]);
                }
                else if($type=='p') {
                    fputcsv($handle, [$this->ic('개인용 가공변수'),$this->ic('합계')]);
                }
                else if($type=='h_src') {
                    fputcsv($handle, [$this->ic('변수추가 가구용'),$this->ic('합계')]);
                }
                else if($type=='p_src') {
                    fputcsv($handle, [$this->ic('변수추가 개인용'),$this->ic('합계')]);
                }
                else if($type=='wave_a') {
                    fputcsv($handle, [$this->ic('차수'),$this->ic('합계')]);
                }
                else if($type=='var_a') {
                    fputcsv($handle, [$this->ic('부가조사 변수추가'),$this->ic('합계')]);
                }

                else if($type=='file') {
                    fputcsv($handle, [$this->ic('저장파일타입'),$this->ic('합계')]);
                }
                else if($type=='s_wave') {
                    fputcsv($handle, [$this->ic('차수'),$this->ic('합계')]);
                }
                else if($type=='s_type') {
                    fputcsv($handle, [$this->ic('변수검색 타입'),$this->ic('합계')]);
                }
                else if($type=='s_word') {
                    fputcsv($handle, [$this->ic('변수검색 단어'),$this->ic('합계')]);
                }
                else if($type=='step2') {
                    fputcsv($handle, [$this->ic('변수추가/선택분석'),$this->ic('합계')]);
                }



                foreach ($r as $e) {
                    fputcsv($handle, [$this->ic($e['value']), $e['cnt']]);
                }


                fclose($handle);
            }, 200, [
                'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
                'Content-type'        => 'text/csv',
                'Content-Disposition' => "attachment; filename={$filename}",
                'Expires'             => '0',
                'Pragma'              => 'public',
            ]);
        }
        else {
            return view('voyager::analysis.browse', compact(
                'started_atC',
                'ended_atC',
                'chartjs',
                'type',
            ));
        }

//        dump($r);
    }
/*
    const COLORS = [
        '#4dc9f6',
        '#f67019',
        '#f53794',
        '#537bc4',
        '#acc236',
        '#166a8f',
        '#00a950',
        '#58595b',
        '#8549ba'
    ];


export const CHART_COLORS = {
  red: 'rgb(255, 99, 132)',
  orange: 'rgb(255, 159, 64)',
  yellow: 'rgb(255, 205, 86)',
  green: 'rgb(75, 192, 192)',
  blue: 'rgb(54, 162, 235)',
  purple: 'rgb(153, 102, 255)',
  grey: 'rgb(201, 203, 207)'
};*/

    /*        $r = Analysis::select(DB::raw($q))->where('type' ,$type)
    ->whereBetween('created_at', [$started_atC->toDateTimeString(),$ended_atC->toDateTimeString()])
    ->groupby('date')
    ->take(10)->orderBy('date')->get();*/

    //$trend = Trend::query(Analysis::where('type', $type))->between(start: $started_atC, end: $ended_atC)->perDay()->count();
    //$result  = $trend->map(fn (TrendValue $value) => $value->date);
    //dump($trend);

    public function chgValueToLb($type, $r)
    {
        if(in_array($type, ['step2'])) {
            foreach ($r as $rv) {
                if($rv->value=='h') {
                    $rv->value = '가구용 가공변수';
                }
                else if($rv->value=='p') {
                    $rv->value = '개인용 가공변수';
                }
                else if($rv->value=='src') {
                    $rv->value = '원자료 변수추가';
                }
                else if($rv->value=='src_a') {
                    $rv->value = '부가조사';
                }
            }
        }
        return $r;
    }


    public function makePeriod($type)
    {
        $started_at =  request('started_at');
        $ended_at =  request('ended_at');

        $started_atC = new Carbon($started_at);
        $ended_atC = new Carbon($ended_at);

        $periodtype = request('periodtype', 'month');

        if($periodtype == 'day') {
            if($started_at=='') {
                $started_atC = now()->startOfMonth();
            }
            if($ended_at=='') {
                $ended_atC = now()->endOfMonth();
            }
        }
        else  if($periodtype == 'month') {
            if($started_at=='') {
                $started_atC = now()->startOfYear();
            }
            if($ended_at=='') {
                $ended_atC = now()->endOfYear();
            }
        }
        else if($periodtype == 'year') {
            if($started_at=='') {
                $started_atC = now()->startOfYear()->subYears(10);
            }
            if($ended_at=='') {
                $ended_atC = now()->endOfYear();
            }
        }

        if($periodtype == 'day') {
            $date_format = ' date_format(created_at, "%Y-%m-%d") as date ';
        }
        else  if($periodtype == 'month') {
            $date_format = ' date_format(created_at, "%Y-%m") as date ';
        }
        else if($periodtype == 'year') {
            $date_format = ' date_format(created_at, "%Y") as date ';
        }

        return compact('started_atC', 'ended_atC', 'date_format');
    }

    public function makeQeuryByType($type)
    {
        $query = "";
        if($type=='wave') {
            return $this->anylysisByWaves('차수');
        }
        //h,  p, h_src, p_src
        else {
            return $this->anylysisByValues();
        }


        return 'there is no type for make query';
    }

    public function anylysisByWaves($typeName)
    {
        $usingValues  = Setting::select('value')->where('group', $typeName)->where('isUse', 1)->get();
        $query = '';
        foreach ($usingValues as $usingValue) {
            if($typeName=='차수') {
                $v = (int)$usingValue['value'];
            }
            else {
                $v = $usingValue['value'];
            }
            $query .= " count(case when value = '${v}' then 1 end) as '${v}', ";
        }
        return $query;
    }

    function ic($v) {
        try {
            //$v = str_replace('샾','#', $v);
            return iconv("UTF-8","EUC-KR",$v);
        } catch (\Exception $e) {
            return '--';
        }
    }
}
