<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LiveFeed;
use Illuminate\Support\Facades\DB;
use stdClass;

class LiveFeedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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


        return view('livefeed.index', compact('data'));
    }

    public function data()
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

        return response()->json($data);
    }

    public function addData(Request $request)
    {
        // return response()->json($request);
        $pepe = new LiveFeed();
        $pepe->Data = $request->Json;
        $pepe->location_id = $request->AntennaId;

        $pepe->save();

        return response()->json($pepe);
    }
}
