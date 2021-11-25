<?php

namespace App\Http\Controllers;

use App\Events\LiveFeedUpdate;
use App\Events\LocationUpdate;
use Illuminate\Http\Request;
use App\Models\LiveFeed;
use App\Models\Location;
use App\Models\AppUser;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
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


    public function sendWebNotification($title, $body, $token)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $FcmToken = $token;
        $serverKey = 'AAAAyHwBLgg:APA91bED7eNOTND63C5o37peGrBRxVhP8zkqxdAOjV37NhSRcXQ1toyU5SUELROBMB9_3RTyd-mQAlq2Jd2_82VNjY-muBdSA0BxuJDWd4ldTynmyPee3z2buyqAbawDOnpKtnMwNrsf';


        $fields = array();
        $fields['priority'] = "high";
        $fields['notification'] = [
            "title" => $title,
            "body" => $body,
            'data' => ['message' => $body],
            "sound" => "default"
        ];
        if (is_array($FcmToken)) {
            $fields['registration_ids'] = $FcmToken;
        } else {
            $fields['to'] = $FcmToken;
        }

        $encodedData = json_encode($fields);

        $headers = [
            'Authorization:key=' . $serverKey,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);

        // Execute post
        $result = curl_exec($ch);

        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }

        // Close connection
        curl_close($ch);

        return $result;
        // FCM response
        //dd($result);
    }

    public function dataLocation()
    {
        $location = DB::table('tags')
            ->join('locations', 'locations.TagID', '=', 'tags.Tag')
            ->join('vehicles', 'vehicles.id', '=', 'tags.vehicle_id')
            ->orderByDesc('locations.id')
            ->select('locations.id', 'locations.Location', 'locations.TagID', 'locations.Latitude', 'locations.Longitude', 'vehicles.LicensePlate', 'vehicles.Make', 'vehicles.Model', 'vehicles.Color')
            ->first();

        return response()->json($location);
    }

    public function sendData($macAddress, $coordinateid, $VIN, $Token)
    {
        $datetime = Carbon::now()->subMinutes(1)->toDateTimeString();

        $locationinfo = DB::table('coordinates')
            ->select('coordinates.*')
            ->where('coordinates.id', $coordinateid)
            ->first();

        $exists = DB::table('locations')
            ->where('locations.TagID', $macAddress)
            ->where('created_at', '>=', $datetime)
            ->exists();

        if ($exists == true) {
            return null;
        } else {
            Log::info('This is some useful information.');

            $data = new Location();
            $Title = 'AssetTracker';
            $Body = 'Visto en ' . $locationinfo->Location;

            $data->Location = $locationinfo->Location;
            $data->TagID = $macAddress;
            $data->Latitude = $locationinfo->Latitude;
            $data->Longitude = $locationinfo->Longitude;

            $data->save();

            /*
            $location = DB::table('locations')
                ->where('locations.id', $data->id)
                ->select('locations.id', 'locations.Location', 'locations.TagID', 'locations.Latitude', 'locations.Longitude')
                ->first();
            */

            $location = DB::table('tags')
                ->join('locations', 'locations.TagID', '=', 'tags.Tag')
                ->join('vehicles', 'vehicles.id', '=', 'tags.vehicle_id')
                ->where('locations.id', $data->id)
                ->orderByDesc('locations.id')
                ->select('locations.id', 'locations.Location', 'locations.TagID', 'locations.Latitude', 'locations.Longitude', 'vehicles.LicensePlate', 'vehicles.Make', 'vehicles.Model', 'vehicles.Color')
                ->first();

            broadcast(new LocationUpdate($location));

            $this->sendWebNotification($Title, $Body, $Token);

            return $location;
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

        $matricula = $VIN->VIN;

        $token = DB::table('vehicles')
            ->join('app_users', 'app_users.id', '=', 'vehicles.app_user_id')
            ->where('vehicles.id', $vehicle_id->vehicle_id)
            ->select('app_users.Token')
            ->get();

        $fmctoken = $token[0]->Token;

        if ($exists == true) {
            return $this->sendData($macAddress, $coordinateid, $matricula, $fmctoken);
        } else {
            return "pepe1";
        }
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

        $respuestaDeVerdad = $this->checkReports($pepe);
        $pepe->respuestaDeVerdad = $respuestaDeVerdad;

        return response()->json($pepe);
    }
}
