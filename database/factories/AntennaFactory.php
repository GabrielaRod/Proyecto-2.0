<?php

namespace Database\Factories;

use App\Models\Antenna;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class AntennaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Antenna::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'MacAddress' => $this->faker->macAddress,
            'Location' => $this->faker->address,
            'coordinate_id' => rand(1, 5),
            'Status' =>  $this->faker->randomElement(['ACTIVE', 'INACTIVE']),

        ];
    }
}
