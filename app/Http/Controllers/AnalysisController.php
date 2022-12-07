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
                $wavesArr = [];
                foreach ($waves as $wave) {
                    $wavesArr[] = ['type'=>'wave', 'value'=> (int)$wave];
                }
                Analysis::insert($wavesArr);
            }

            /////////////////////////////////////
            // 가구용 원자료 변수
            if(request('kt_select2_3')) {
                $hs = request('kt_select2_3');
                $hsArr = [];
                foreach ($hs as $h) {
                    $hsArr[] = ['type'=>'h', 'value'=> $h];
                }
                Analysis::insert($hsArr);
                $step2Arr[] = ['type' => 'step2', 'value' => 'h'];
            }

            /////////////////////////////////////
            // 개인용 원자료 변수
            if(request('kt_select2_4')) {
                $ps = request('kt_select2_4');
                $psArr = [];
                foreach ($ps as $p) {
                    $psArr[] = ['type'=>'p', 'value'=> $p];
                }
                Analysis::insert($psArr);
                $step2Arr[] = ['type' => 'step2', 'value' => 'p'];
            }


            /////////////////////////////////////
            // 가구용 Klips 원자료 변수 추가
            if(request('add_h')) {
                $add_hs = explode(' ', request('add_h'));
                $addHArr = [];
                foreach ($add_hs as $add_h) {
                    $addHArr[] = ['type'=>'h_src', 'value'=> $add_h];
                }
                Analysis::insert($addHArr);
                $step2Arr[] = ['type' => 'step2', 'value' => 'src']; // 원자료 변수 추가
            }
            /////////////////////////////////////
            // 개인용 Klips 원자료 변수 추가
            if(request('add_p')) {
                $add_ps = explode(' ', request('add_p'));
                $addPArr = [];
                foreach ($add_ps as $add_p) {
                    $addPArr[] = ['type'=>'p_src', 'value'=> $add_p];
                }
                Analysis::insert($addPArr);
                $step2Arr[] = ['type' => 'step2', 'value' => 'src']; // 원자료 변수 추가
            }


            /////////////////////////////////////
            //  부가조사 차수
            if(request('a_wave')) {
                $a_waves = request('a_wave');
                $a_wavesArr = [];
                foreach ($a_waves as $a_wave) {
                    $a_wavesArr[] = ['type'=>'wave_a', 'value'=> (int)$a_wave['value']];
                }
                Analysis::insert($a_wavesArr);
                $step2Arr[] = ['type' => 'step2', 'value' => 'src_a']; // 원자료 부가조사
            }

            /////////////////////////////////////
            // 부가 조사 차수 변수
            if(request('add_a')) {
                $add_as = request('add_a');
                $addAArr = [];
                foreach ($add_as as $add_a) {
                    $addAArr[] = ['type'=>'var_a', 'value'=> $add_a];
                }
                Analysis::insert($addAArr);
            }

            /////////////////////////////////////
            // 파일 저장 타입
            if(request('filesave')) {
                $fileSaves = request('filesave');
                $filesaveArr = [];
                foreach ($fileSaves as $fileSave) {
                    $filesaveArr[] = ['type'=>'file', 'value'=> $fileSave];
                }
                Analysis::insert($filesaveArr);
            }


            /////////////////////////////////////
            // step2 추이초사
            if(count($step2Arr) > 0) {
                Analysis::insert($step2Arr);
            }

        }


        /////////////////////////////////////// 2번째 탭 /////////////////////////////////////

        /////////////////////////////////////
        // 차수
        else if($tab=='search') {
            if(request('kt_select2_5')) {
                $waves = request('kt_select2_5');
                $wavesArr = [];
                foreach ($waves as $wave) {
                    $wavesArr[] = ['type'=>'s_wave', 'value'=> (int)$wave];
                }
                Analysis::insert($wavesArr);
            }

            if(request('word')) {
                $word = request('word');
                $wordArr[] = ['type' => 'word', 'value' => $word];
                Analysis::insert($wordArr);
            }

            if(request('hp')) {
                $hp = request('hp');
                $hpArr[] = ['type' => 's_type', 'value' => $hp];
                Analysis::insert($hpArr);
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
            ->whereBetween('created_at', [$started_atC->toDateTimeString(),$ended_atC->toDateTimeString()])
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
            $chartjs = app()->chartjs
                ->name('lineChartTest')
                ->type('line')
                ->size(['width' => 800, 'height' => 200])
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
        return view('voyager::analysis.browse', compact(
            'started_atC',
            'ended_atC',
            'chartjs',
            'type',
        ));

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
}
