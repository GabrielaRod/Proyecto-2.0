<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\AppUser;

class AppUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AppUser::factory(4)->create();

        DB::table('app_users')->insert([
        	'FirstName' => 'Gabriela',
        	'LastName' => 'Rodriguez',
        	'DomID' => 40288591759,
        	'Address' => 'Calle Sanchez #39',
        	'City' => 'Puerto Plata',
        	'PhoneNumber' => 8095137521,
        	'Email' => 'gabrielarodb@gmail.com',
        	'Password' => bcrypt('P@ssword2021'),
        ]);
    }
}
