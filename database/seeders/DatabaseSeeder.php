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
            AppUserTableSeeder::class,
            VehiclesTableSeeder::class,
            //AppUserVehicleTableSeeder::class,
            TagsTableSeeder::class,
            CoordinatesTableSeeder::class,
            AntennasTableSeeder::class,  
            AntennaCoordinateTableSeeder::class, 
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            PermissionRoleTableSeeder::class,
            RoleUserTableSeeder::class,     
        ]);
    }
}
