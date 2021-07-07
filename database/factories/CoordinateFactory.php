<?php

namespace Database\Factories;

use App\Models\Coordinate;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class CoordinateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Coordinate::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'Location' => $faker->address,
            'Latitude' => $faker->latitude($min = -90, $max = 90),
            'Longitud' => $faker->longitude($min = -180, $max = 180),    
        ];
    }
}
