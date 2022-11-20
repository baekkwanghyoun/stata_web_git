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
            ->take(10)->get();


/*        $r = Analysis::select(DB::raw($q))->where('type' ,$type)
            ->whereBetween('created_at', [$started_atC->toDateTimeString(),$ended_atC->toDateTimeString()])
            ->groupby('date')
            ->take(10)->orderBy('date')->get();*/

        dump($r);

        //$trend = Trend::query(Analysis::where('type', $type))->between(start: $started_atC, end: $ended_atC)->perDay()->count();
        //$result  = $trend->map(fn (TrendValue $value) => $value->date);
        //dump($trend);
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
