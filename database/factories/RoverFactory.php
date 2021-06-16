<?php

namespace Database\Factories;

use App\Models\Rover;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoverFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Rover::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'x' => $this->faker->randomNumber(2,false),
            'y' => $this->faker->randomNumber(2,false),
            'direction' => $this->faker->randomElement(config('rovers.directions')),
        ];
    }
}
