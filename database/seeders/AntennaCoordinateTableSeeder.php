<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Coordinate;

class AntennaCoordinateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Coordinate::findOrFail(1)->antennas()->sync(1);
        Coordinate::findOrFail(2)->antennas()->sync(4);
        Coordinate::findOrFail(3)->antennas()->sync(3);
        Coordinate::findOrFail(4)->antennas()->sync(2);
    }
}
