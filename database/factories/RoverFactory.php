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
            'x' => $this->faker->numberBetween(0,100) * $this->faker->randomElement([1, -1]),
            'y' => $this->faker->numberBetween(0,100) * $this->faker->randomElement([1, -1]),
            'direction' => $this->faker->randomElement(config('rovers.directions')),
        ];
    }
}
