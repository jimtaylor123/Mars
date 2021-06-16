<?php

namespace Database\Seeders;

use App\Models\Rover;
use Illuminate\Database\Seeder;

class RoverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rover::factory(5)->create();
    }
}
