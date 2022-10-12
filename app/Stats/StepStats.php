<?php

namespace App\Stats;
use Spatie\Stats\BaseStats;

//use Spatie\Stats\Traits\HasStats;


class StepStats extends BaseStats
{
    public $name;

    public function getName() : string{
        $this->name = 'my-custom-name';
        return $this->name;
    }

    public function setName($s){
        $this->name = $s;
        //return $this->name;
    }
}
