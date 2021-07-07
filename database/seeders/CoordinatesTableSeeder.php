<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Coordinate;

class CoordinatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('coordinates')->insert([
        	'Location' => 'Av. Juan Pablo Duarte Int. Estrella Sadhala',
        	'Latitude' => '19.450065310836933',
        	'Longitude' => '-70.68698733231116',
            'created_at'=> date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('coordinates')->insert([
        	'Location' => '27 de Febrero Int. Estrella Sadhala',
        	'Latitude' => '19.46060976872026',
        	'Longitude' => '-70.68626263308528',
            'created_at'=> date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('coordinates')->insert([
        	'Location' => 'Rep. de Argentina Int. Estrella Sadhala',
        	'Latitude' => '19.452937129509245',
        	'Longitude' => '-70.68487275571492',
            'created_at'=> date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('coordinates')->insert([
        	'Location' => 'Autopista Duarte Int. Estrella Sadhala',
        	'Latitude' => '19.458783601114526',
        	'Longitude' => '-70.68615650623265',
            'created_at'=> date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
