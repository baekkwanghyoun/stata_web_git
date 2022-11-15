<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            analysisSeeder::class,
        ]);

        //Analysis::factory(100)->create();
        //User::factory(10)->create();
    }
}
