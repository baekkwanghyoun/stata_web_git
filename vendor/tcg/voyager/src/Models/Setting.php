<?php

namespace TCG\Voyager\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use TCG\Voyager\Events\SettingUpdated;

class Setting extends Model
{
    use LogsActivity;

    protected $fillable = ['key', 'type', 'display_name', 'value', 'group', 'order'];


    protected $table = 'settings';

    protected $guarded = [];

    public $timestamps = false;

    protected $dispatchesEvents = [
        'updating' => SettingUpdated::class,
    ];


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['display_name', 'value', 'group', 'order'])
            ->logOnlyDirty();
        // Chain fluent methods for configuration options
    }
}
