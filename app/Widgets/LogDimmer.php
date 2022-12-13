<?php

namespace App\Widgets;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\Activitylog\Models\Activity;
use TCG\Voyager\Facades\Voyager;

class LogDimmer extends BaseDimmer
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $countCreate = Activity::where('description', 'created')->whereDate('updated_at',  Carbon::today())->count();
        $countUpdate = Activity::where('description', 'updated')->whereDate('updated_at',  Carbon::today())->count();
        $countDelete = Activity::where('description', 'deleted')->whereDate('updated_at',  Carbon::today())->count();
        $totCnt = $countUpdate + $countCreate + $countDelete;


        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-logbook',
            'title'  => "오늘의 수행기록 : {$totCnt}",
            'text'   => "생성 : {$countCreate},  수정 : {$countUpdate}, 삭제 : {$countDelete}",
            'button' => [
                'text' => '수행기록 바로가기',
                'link' => route('voyager.activity-log.index'),
            ],
            'image' => voyager_asset('images/widget-backgrounds/02.jpg'),
        ]));
    }

    /**
     * Determine if the widget should be displayed.
     *
     * @return bool
     */
    public function shouldBeDisplayed()
    {
        return Auth::user()->can('browse', Voyager::model('User'));
    }
}
