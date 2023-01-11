<?php

namespace App\Http\Controllers\Voyager;

use App\Models\Visit;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Facades\Voyager;

class VisitController extends \TCG\Voyager\Http\Controllers\VoyagerBaseController
{
    public function index(Request $request)
    {

        /*@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@*/
        /* Chart start */
        /*@@@@@@@@@@
        @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@*/
        $uri = $request->getPathInfo();
        $type = 'visit';
        if($uri == '/admin/stat/visit') {
            $type = 'visit';
        } else if($uri == '/admin/stat/os') {
            $type = 'os';
        } else if($uri == '/admin/stat/browser') {
            $type = 'browser';
        }

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


        /*@@@@@@@@@@@@@@@@@@@@@*/
        /* query for type */
        /*@@@@@@@@@@@@@@@@@@@@@*/
        if($type=='visit') {
            $trend = Trend::model(Visit::class)->between(start: $started_atC, end: $ended_atC);
        }
        else if($type=='browser') {
            $trend = Trend::query(
                Visit::query()->select(
                    DB::raw(
                        'count(case when browser = "chrome" then 1 end) as "chrome",
                            count(case when browser = "edge" then 1 end) as "edge",
                            count(case when browser = "mozilla" then 1 end) as "mozilla",
                            count(case when browser = "firefox" then 1 end) as "firefox"',
                    )
                )
            )->between(start: $started_atC, end: $ended_atC);
        }
        else if($type=='os') {
            $trend = Trend::query(
                Visit::query()->select(
                    DB::raw(
                        'count(case when platform = "windows" then 1 end) as "windows",
                            count(case when platform = "ios" then 1 end) as "ios",
                            count(case when platform = "phone" then 1 end) as "phone"',
                    )
                )
            )->between(start: $started_atC, end: $ended_atC);
        }


        if($dv == 'day') {
            $trend = $trend->perDay()->count();
        }
        else  if($dv == 'month') {
            $trend = $trend->perMonth()->count();
        }
        else if($dv == 'year') {
            $trend = $trend->perYear()->count();
        }

//dump($trend);

        $a  = $trend->map(fn (TrendValue $value) => $value->date);


        //visit, browser, os, device
        /*@@@@@@@@@@@@@@@@@@@@@*/
        /* make chart for type */
        /*@@@@@@@@@@@@@@@@@@@@@*/
        if($type=='visit') {

            $excel = $trend->map(function ($t) {
                return collect($t)->only(['date', 'aggregate']);
            });


            $chartjs = app()->chartjs
                ->name('lineChartTest')
                ->type('bar')
                ->size(['width' => 800, 'height' => 200])
                ->labels($a->toArray())
                ->datasets([
                    [
                        "label" => "방문횟수",
                        'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                        'borderColor' => "rgba(38, 185, 154, 0.7)",
                        "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                        "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                        "pointHoverBackgroundColor" => "#fff",
                        "pointHoverBorderColor" => "rgba(220,220,220,1)",
                        'data' => $trend->map(fn (TrendValue $value) => $value->aggregate),
                    ],

                ])
                ->options(['responsive',true]);
        }
        else if($type=='browser') {

            $excel = $trend->map(function ($t) {
                return collect($t)->only(['date', 'firefox', 'mozilla', 'edge', 'chrome']);
            });

            $chartjs = app()->chartjs
                ->name('lineChartTest')
                ->type('line')
                ->size(['width' => 800, 'height' => 200])
                ->labels($a->toArray())
                ->datasets([
                    [
                        "label" => "firefox",
                        'data' => $trend->map(fn (TrendValue $value) => $value->firefox),
                        'backgroundColor' => "rgb(198, 235, 197,0.3)",
                    ],
                    [
                        "label" => "mozilla",
                        'data' => $trend->map(fn (TrendValue $value) => $value->mozilla),
                        'backgroundColor' => "rgb(161, 194, 152,0.4)",
                    ],
                    [
                        "label" => "edge",
                        'data' => $trend->map(fn (TrendValue $value) => $value->edge),
                        'backgroundColor' => "rgb(251, 242, 207,0.5)",
                    ],
                    [
                        "label" => "chrome",
                        'data' => $trend->map(fn (TrendValue $value) => $value->chrome),
                        'backgroundColor' => "rgb(250, 112, 112, 0.7)",
                    ],
                ])
                ->optionsRaw("{
                        responsive: true,
                        scales: {
                          x: {
                            stacked: true,
                          },
                          y: {
                            stacked: true
                          }
                        }
                    }"
                );
        }
        else if($type=='os') {

            $a  = $trend->map(fn (TrendValue $value) => $value->date);

            $excel = $trend->map(function ($t) {
                return collect($t)->only(['date', 'windows', 'ios', 'phone']);
            });

            $chartjs = app()->chartjs
                ->name('lineChartTest')
                ->type('line')
                ->size(['width' => 800, 'height' => 200])
                ->labels($a->toArray())
                ->datasets([
                    [
                        "label" => "windows",
                        'data' => $trend->map(fn (TrendValue $value) => $value->windows),
                        'backgroundColor' => "rgb(198, 235, 197,0.3)",
                    ],
                    [
                        "label" => "ios",
                        'data' => $trend->map(fn (TrendValue $value) => $value->ios),
                        'backgroundColor' => "rgb(161, 194, 152,0.4)",
                    ],
                    [
                        "label" => "phone",
                        'data' => $trend->map(fn (TrendValue $value) => $value->phone),
                        'backgroundColor' => "rgb(161, 194, 152,0.4)",
                    ],
                ])
                ->optionsRaw("{
                        responsive: true,
                        scales: {
                          x: {
                            stacked: true,
                          },
                          y: {
                            stacked: true
                          }
                        }
                    }"
                );
        }



        /*@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@*/
        /* Chart end */
        /*@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@*/

        $view = 'voyager::bread.browse';

      /*  if (view()->exists("voyager::.browse")) {
            $view = "voyager::Visit.browse";
        }*/

        if ($request->get('type') === 'csv') {
            $now = (new \Carbon\Carbon())->format("ymd");
            $filename = "visit_{$type}_{$now}.csv";

            return response()->stream(function () use($filename, $excel, $type) {
                $handle = fopen('php://output', 'w+');

                fputcsv($handle, [$this->ic('검색기간'), ]);
                fputcsv($handle, [$this->ic('시작일'), request('started_at'), $this->ic('종료일'), request('ended_at')]);
                fputcsv($handle, []);

                if($type=='visit') {
                    fputcsv($handle, [$this->ic('날짜'),$this->ic('합계')]);
                } else if($type=='browser') {
                    fputcsv($handle, [$this->ic('날짜'), 'firefox', 'mozilla', 'edge', 'chrome']);
                } else if($type=='os') {
                    fputcsv($handle, [$this->ic('날짜'), 'windows', 'ios', 'phone']);
                }

                foreach ($excel as $e) {
                    if($type=='visit') {
                        fputcsv($handle, [$e['date'], $e['aggregate']]);
                    } else if($type=='browser') {
                        fputcsv($handle, [$e['date'], $e['firefox'], $e['mozilla'], $e['edge'],$e['chrome']]);
                    } else if($type=='os') {
                        fputcsv($handle, [$e['date'], $e['windows'], $e['ios'], $e['phone']]);
                    }
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
            return view('voyager::shetabit-visits.browse', compact(
                'started_atC',
                'ended_atC',
                'chartjs',
                'type',
            ));
        }
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
