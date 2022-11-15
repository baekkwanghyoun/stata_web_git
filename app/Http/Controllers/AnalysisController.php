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

        $dv = request('dv', 'month');
        $started_at =  request('started_at');
        $ended_at =  request('ended_at');

        $started_atC = new Carbon($started_at);
        $ended_atC = new Carbon($ended_at);

        if($dv == 'day') {
            if($started_at=='') {
                $started_atC = now()->startOfMonth();
            }
            if($ended_at=='') {
                $ended_atC = now()->endOfMonth();
            }
        }
        else  if($dv == 'month') {
            if($started_at=='') {
                $started_atC = now()->startOfYear();
            }
            if($ended_at=='') {
                $ended_atC = now()->endOfYear();
            }
        }
        else if($dv == 'year') {
            if($started_at=='') {
                $started_atC = now()->startOfYear()->subYears(10);
            }
            if($ended_at=='') {
                $ended_atC = now()->endOfYear();
            }
        }
        $usingWaves  = Setting::select('value')->where('group', '차수')->where('isUse', 1)->get();
        $waveQuery = '';
        foreach ($usingWaves as $usingWave) {
            $intWave = (int)$usingWave['value'];
            $waveQuery .= " count(case when value = '${intWave}' then ${intWave} end) as '${intWave}', ";
/*            if($usingWaves->last() != $usingWave) {
                $waveQuery .= ',';
            }*/
        }
        $waveQuery .= ' date_format(created_at, "%Y-%m") as date ';
        //DB::raw($waveQuery)
        $r = Analysis::select(DB::raw($waveQuery))->where('type' ,'wave')
            ->whereBetween('created_at', [$started_atC->toDateTimeString(),$ended_atC->toDateTimeString()])
            ->groupby('date')
            ->take(10)->get();
        dump($r);

        $trend = Trend::query(Analysis::query()->select(DB::raw($waveQuery)))->between(start: $started_atC, end: $ended_atC);

        if($dv == 'day') {
            $trend = $trend->perDay()->count();
        }
        else  if($dv == 'month') {
            $trend = $trend->perMonth()->count();
        }
        else if($dv == 'year') {
            $trend = $trend->perYear()->count();
        }

        //$result  = $trend->map(fn (TrendValue $value) => $value->date);

        dump($trend);
    }
}
