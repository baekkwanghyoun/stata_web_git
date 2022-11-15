<?php

namespace Database\Factories;

use App\Models\Analysis;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnalysesFactory extends Factory
{
    protected $model = Analysis::class;

    public function definition(): array
    {
        return [
            'type'=> fake()->randomElement(['wave']),
            'value'=>fake()->numberBetween(1, 23)
        ];
    }
}
