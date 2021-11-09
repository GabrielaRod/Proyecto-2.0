<?php

namespace Database\Factories;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;


class VehicleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vehicle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $license = $this->faker->unique()->randomElement($array = array ('A9938375', 'G8186440', 'A2183747', 'G7486888', 'A6958025'));
        $vin = $this->faker->shuffle('ABCWXYZ0123456789');
        $year = $this->faker->year($max = 'now');
        $color = $this->faker->randomElement($array = array ('Red', 'White', 'Blue', 'Black', 'Grey'));
        $make = 'Honda';
        $model = $this->faker->randomElement($array = array ('CR-V', 'HR-V', 'Accord', 'Civic', 'Pilot'));
        $type = $this->faker->randomElement($array = array ('Car', 'SUV'));

        return [
            'LicensePlate' => $license,
            'VIN' => $vin,
            'Make' => $make,
            'Model' => $model,
            'Year' => $year,
            'Color' => $color,
            'Type' => $type,
            'app_user_id' => rand(1,5),
            'Status' => 'Active',
        ];
    }
}
