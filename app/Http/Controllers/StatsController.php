<?php

namespace App\Http\Controllers;

use App\Models\Stat;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function savefiletype()
    {
        $chartjs = app()->chartjs
            ->name('lineChartTest')
            ->type('bar')
            ->size(['width' => 400, 'height' => 200])
            ->labels(['January', 'February', 'March', 'April', 'May', 'June', 'July'])
            ->datasets([
                [
                    "label" => "My First dataset",
                    /*                    'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                                        'borderColor' => "rgba(38, 185, 154, 0.7)",
                                        "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                                        "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                                        "pointHoverBackgroundColor" => "#fff",
                                        "pointHoverBorderColor" => "rgba(220,220,220,1)",*/
                    'data' => [65, 59, 80, 81, 56, 55, 40],
                ],
                [
                    "label" => "My Second dataset",
                    /*                    'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                                        'borderColor' => "rgba(38, 185, 154, 0.7)",
                                        "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                                        "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                                        "pointHoverBackgroundColor" => "#fff",
                                        "pointHoverBorderColor" => "rgba(220,220,220,1)",*/
                    'data' => [12, 33, 44, 44, 55, 23, 40],
                ]
            ])
            ->options([]);

        $chartjs2 = app()->chartjs
            ->name('barChartTest')
            ->type('bar')
            ->size(['width' => 400, 'height' => 200])
            ->labels(['Label x', 'Label y'])
            ->datasets([
                [
                    "label" => "My First dataset",
                    'backgroundColor' => ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)'],
                    'data' => [69, 59]
                ],
                [
                    "label" => "My First dataset",
                    'backgroundColor' => ['rgba(255, 99, 132, 0.3)', 'rgba(54, 162, 235, 0.3)'],
                    'data' => [65, 12]
                ]
            ])
            ->options([]);
        return view('stat.savefiletype', compact('chartjs', 'chartjs2'));
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Stat $stat)
    {
        //
    }

    public function edit(Stat $stat)
    {
        //
    }

    public function update(Request $request, Stat $stat)
    {
        //
    }

    public function destroy(Stat $stat)
    {
        //
    }
}
