<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coordinate;
use App\Models\Location;
use Illuminate\Support\Facades\DB;
use stdClass;
use App\Events\LiveFeedUpdate;

class PageController extends Controller
{
    public function markers()
    {
        /*The antenas that show in the Map are only the ones that are ACTIVE*/
        $markers = collect();

        /* TODO: PROBAR CON LA TABLA LOCATIONS PARA SOLO PRESENTAR ALGUN VIN QUE TENGA COMO STATUS ACTIVO EN TABLA REPORTS */

        $coordinates = DB::table('locations')
                        ->select('locations.latitude', 'locations.longitude', 'locations.TagID')
                        ->get();

        foreach ($coordinates as $c) {
            $marker = new stdClass();
            $marker->latitude = $c->latitude;
            $marker->longitude = $c->longitude; 
            $marker->infoText = $c->TagID; 
            $markers->add($marker);
        }

        return $markers;

        /* $coordinates = DB::table('antennas')
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

        return $markers; */
    }

    public function livedata()
    {
        /*The antenas that show in the Map are only the ones that are ACTIVE*/
        $data = collect();

        /* TODO: PROBAR CON LA TABLA LOCATIONS PARA SOLO PRESENTAR ALGUN VIN QUE TENGA COMO STATUS ACTIVO EN TABLA REPORTS */

        $locations = DB::table('livefeed')
                    ->join('coordinates', 'coordinates.id', '=', 'livefeed.location_id')
                    ->select('livefeed.id', 'livefeed.data', 'coordinates.location')
                    ->get();

        foreach ($locations as $c) {
            $dat = new stdClass();
            $dat->id = $c->id;
            $dat->data = $c->data;
            $dat->location = $c->location; 
            $data->add($dat);
        }

        
        return $data;        
        //return view('livefeed.index', compact('data'));
    }

}
