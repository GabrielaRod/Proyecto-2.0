<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

class ReportsController extends Controller
{
    public function alertReport()
    {
        /*The antenas that show in the Map are only the ones that are ACTIVE*/
        $reports = collect();

        /* TODO: PROBAR CON LA TABLA LOCATIONS PARA SOLO PRESENTAR ALGUN VIN QUE TENGA COMO STATUS ACTIVO EN TABLA REPORTS */

        $data = DB::table('reports')
            ->select('reports.id', 'reports.VIN', 'reports.LicensePlate', 'reports.Make', 'reports.Model', 'reports.Color', 'reports.FirstName', 'reports.LastName', 'reports.Status', 'reports.created_at')
            ->get();

        foreach ($data as $d) {
            $dat = new stdClass();
            $dat->id = $d->id;
            $dat->VIN = $d->VIN;
            $dat->LicensePlate = $d->LicensePlate;
            $dat->Make = $d->Make;
            $dat->Model = $d->Model;
            $dat->Color = $d->Color;
            $dat->FirstName = $d->FirstName;
            $dat->LastName = $d->LastName;
            $dat->Status = $d->Status;
            $reports->add($dat);
        }


        return $data;
        //return view('reports.index', compact('reports'));
    }
}
