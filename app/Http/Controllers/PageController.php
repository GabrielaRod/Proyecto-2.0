<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coordinate;
use Illuminate\Support\Facades\DB;
use stdClass;

class PageController extends Controller
{
    public function markers()
    {
        /*The antenas that show in the Map are only the ones that are ACTIVE*/
        $markers = collect();

        $coordinates = DB::table('antennas')
                        ->join('coordinates', 'coordinates.id', '=', 'antennas.coordinate_id')
                        ->select('coordinates.latitude', 'coordinates.longitude')
                        ->where('antennas.status', 'ACTIVE')
                        ->get();

        foreach ($coordinates as $c) {
            $marker = new stdClass();
            $marker->latitude = $c->latitude;
            $marker->longitude = $c->longitude; 
            $markers->add($marker);
        }

        return $markers;
    }

}
