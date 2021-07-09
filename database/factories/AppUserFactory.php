<?php

namespace Database\Factories;

use App\Models\AppUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AppUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        $first = $this->faker->unique()->name;
        $last = $this->faker->lastName;
        $serie = $this->faker->randomElement($array = array (037,031,402));
        $code = $this->faker->numberBetween($min = 1010101, $max = 9999999);
        $rdn = $this->faker->randomDigit;
        $domid = $serie.$code.$rdn;
    
        return [
            'FirstName' => $first,
            'LastName' => $last,
            'DomID' => sprintf("%010d", $domid),
            'Address' => $this->faker->address,
            'City' => $this->faker->city,
            'PhoneNumber' => $this->faker->phoneNumber,
            'Email' => $this->faker->unique()->safeEmail,
            'Password' => $this->faker->unique()->password, // password
            
        ];
    }
}
