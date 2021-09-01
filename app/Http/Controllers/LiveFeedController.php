<?php

namespace App\Http\Controllers;

use App\Events\LiveFeedUpdate;
use App\Events\LocationUpdate;
use Illuminate\Http\Request;
use App\Models\LiveFeed;
use App\Models\Location;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
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

    public function data() //VIEJA FUNCION PARA MANDAR LATITUDE Y LONGITUDE
    {
        /*The antenas that show in the Map are only the ones that are ACTIVE*/
        $data = collect();

        /* TODO: PROBAR CON LA TABLA LOCATIONS PARA SOLO PRESENTAR ALGUN VIN QUE TENGA COMO STATUS ACTIVO EN TABLA REPORTS */

        $locations = DB::table('livefeed')
            ->join('coordinates', 'coordinates.id', '=', 'livefeed.location_id')
            ->select('livefeed.id', 'livefeed.data', 'coordinates.location', 'coordinates.Latitude', 'coordinates.Longitude')
            ->get();

        foreach ($locations as $c) {
            $dat = new stdClass();
            $dat->id = $c->id;
            $dat->data = $c->data;
            $dat->location = $c->location;
            $dat->Latitude = $c->Latitude;
            $dat->Longitude = $c->Longitude;
            $data->add($dat);
        }

        return response()->json($data);
    }

    /* public function addLocation($macAddress, $coordinateid){  //FUNCION QUE FUNCIONA PARA LLENAR LA TABLA LOCATIONS


        $datetime = Carbon::now()->subMinutes(5)->toDateTimeString();

        $locationinfo = DB::table('coordinates')
                        ->select('coordinates.*')
                        ->where('coordinates.id', $coordinateid)
                        ->first();

        $exists = DB::table('locations')
                ->where('locations.TagID', $macAddress)
                ->where('created_at', '<=', $datetime)
                ->exists();

        if($exists == true){
                return 'Already exists';
        }
        else {
            $addlocation = DB::table('locations')
                        ->insert([
                                'Location' => $locationinfo->Location,
                                'TagID' => $macAddress,
                                'Latitude' => $locationinfo->Latitude,
                                'Longitude' => $locationinfo->Longitude
                        ]);

        }

    }  */


    public function dataLocation()
    {
        $location = DB::table('locations')
            ->orderByDesc('locations.id')
            ->select('locations.id', 'locations.Location', 'locations.TagID', 'locations.Latitude', 'locations.Longitude')
            ->first();

        return response()->json($location);
    }

    public function prueba($macAddress, $coordinateid)
    {
        $datetime = Carbon::now()->subMinutes(5)->toDateTimeString();

        $locationinfo = DB::table('coordinates')
            ->select('coordinates.*')
            ->where('coordinates.id', $coordinateid)
            ->first();

        $exists = DB::table('locations')
            ->where('locations.TagID', $macAddress)
            ->where('created_at', '<=', $datetime)
            ->exists();

        if ($exists == true) {
            return 'Already exists';
        } else {

            $data = new Location();

            $data->Location = $locationinfo->Location;
            $data->TagID = $macAddress;
            $data->Latitude = $locationinfo->Latitude;
            $data->Longitude = $locationinfo->Longitude;

            $data->save();

            $location = DB::table('locations')
                ->where('locations.id', $data->id)
                ->select('locations.id', 'locations.Location', 'locations.TagID', 'locations.Latitude', 'locations.Longitude')
                ->first();

            broadcast(new LocationUpdate($location));

            return true;
        }
    }

    public function checkReports($data)
    {

        $jsonenc = str_replace("'", '"', $data->Data);
        $json = json_decode($jsonenc);
        $macAddress = $json->macAddress;
        $coordinateid = $data->location_id;

        $vehicle_id = DB::table('tags')
            ->where('tags.Tag', $macAddress)
            ->select('tags.vehicle_id')
            ->first();

        $VIN = DB::table('vehicles')
            ->where('vehicles.id', $vehicle_id->vehicle_id)
            ->select('vehicles.VIN')
            ->first();


        $exists = DB::table('reports')
            ->where('reports.VIN', $VIN->VIN)
            ->exists();

        if ($exists == true) {
            //return $this->addLocation($macAddress, $coordinateid);
            return $this->prueba($macAddress, $coordinateid);
        } else {
            return false;
        }

        //return $vehicle_id;

    }

    public function addData(Request $request)
    {
        $pepe = new LiveFeed();
        $pepe->Data = $request->Json;
        $pepe->location_id = $request->AntennaId;

        $pepe->save();

        $location = DB::table('livefeed')
            ->join('coordinates', 'coordinates.id', '=', 'livefeed.location_id')
            ->where('livefeed.id', $pepe->id)
            ->select('livefeed.id', 'livefeed.data', 'coordinates.location', 'coordinates.Latitude', 'coordinates.Longitude')
            ->first();

        broadcast(new LiveFeedUpdate($location));

        $this->checkReports($pepe);

        return response()->json($pepe);
    }
}
