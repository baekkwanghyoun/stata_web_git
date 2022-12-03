<?php

namespace App\Models;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class Howto extends Model
{
    use LogsActivity;



    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['title', 'content'])
            ->logOnlyDirty();
        // Chain fluent methods for configuration options
    }
}
