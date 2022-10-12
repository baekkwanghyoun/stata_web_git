<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Stats\Traits\HasStats;

class StatsStep extends Model
{
    use HasStats;
    protected $guarded = [];
}
