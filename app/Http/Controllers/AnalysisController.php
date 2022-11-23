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
        $waves = request('kt_select2_5');
        $wavesArr = [];
        foreach ($waves as $wave) {
            $wavesArr[] = ['type'=>'wave', 'value'=> (int)$wave];
        }
        Analysis::insert($wavesArr);

        // 개인용 원자료 변수
        $hs = request('kt_select2_3');
        $hsArr = [];
        foreach ($hs as $p) {
            $hsArr[] = ['type'=>'p', 'value'=> $wave];
        }
        Analysis::insert($hsArr);

        // 개인용 원자료 변수
        $ps = request('kt_select2_3');
        $psArr = [];
        foreach ($ps as $p) {
            $psArr[] = ['type'=>'p', 'value'=> $wave];
        }
        Analysis::insert($psArr);





        dump(request()->all());
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

        /* 원 */
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
