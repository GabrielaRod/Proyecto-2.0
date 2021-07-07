<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Antenna;

class AntennasTableSeeder extends Seeder
{
     /*
    TODO: WHEN THE LOCATION IS PASSED FROM THE COORDINATES TABLE IT COMES BACK WITH THIS FORMAT: [{"Location":"Av. Juan Pablo Duarte Int. Estrella Sadhala"}]
    IDEA ON HOW TO RESOLVE THIS: If instead of ->get() in the query I add ->get()->value() it should only bring the value of the location.
    */
public function run()
{
            DB::table('antennas')->insert([
                'MacAddress' => '15:9D:AF:BA:E6:24',
                'Location' => DB::table('coordinates')->select('Location')->where('id',1)->get(),
                'coordinate_id' => '1',
                'Status' => 'ACTIVE',
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            DB::table('antennas')->insert([
                'MacAddress' => '94:84:11:C8:42:C1',
                'Location' => DB::table('coordinates')->select('Location')->where('id',2)->get(),
                'coordinate_id' => '2',
                'Status' => 'ACTIVE',
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            DB::table('antennas')->insert([
                'MacAddress' => 'DE:D0:E3:7E:9B:89',
                'Location' => DB::table('coordinates')->select('Location')->where('id',3)->get(),
                'coordinate_id' =>'3',
                'Status' => 'INACTIVE',
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            DB::table('antennas')->insert([
                'MacAddress' => '89:E3:D0:7E:9B:DE',
                'Location' => DB::table('coordinates')->select('Location')->where('id',4)->get(),
                'coordinate_id' => '4',
                'Status' => 'ACTIVE',
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
}
}
