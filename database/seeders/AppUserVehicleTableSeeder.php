<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AppUser;

class AppUserVehicleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AppUser::findOrFail(1)->vehicles()->sync(1);
        AppUser::findOrFail(2)->vehicles()->sync(2);
        AppUser::findOrFail(3)->vehicles()->sync(2);
        AppUser::findOrFail(4)->vehicles()->sync(5);
    }
}
