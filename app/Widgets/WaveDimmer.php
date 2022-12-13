<?php

namespace App\Widgets;

use App\Models\Setting;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\Activitylog\Models\Activity;
use TCG\Voyager\Facades\Voyager;

class WaveDimmer extends BaseDimmer
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
        $waves = Setting::select('value')->where('group', '차수')->where('isUse',  true)->get();
        $cnt = $waves->count();
        $waves = implode(',',$waves->pluck('value')->toArray());
        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-settings',
            'title'  => "사용중 차수 갯수  : {$cnt}",
            /*'title'  => "차수 : {$totCnt}",*/
            'text'   => "사용중인 차수 : {$waves}",
            'button' => [
                'text' => '코드관리 바로가기',
                'link' => route('voyager.activity-log.index'),
            ],
            'image' => voyager_asset('images/widget-backgrounds/03.jpg'),
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
