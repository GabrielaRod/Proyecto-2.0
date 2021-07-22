<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateVehicleRequest;
use App\Models\Vehicle;
use App\Models\AppUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class VehicleController extends Controller
{
    public function index()
    {
        //abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vehicles = Vehicle::all();

        return view('vehicles.index', compact('vehicles'));
    }
    


    public function show(Vehicle $vehicle)
    {

        return view('vehicles.show', compact('vehicle'));
    }

    public function edit(Vehicle $vehicle)
    {
        //abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');


        $app_users = AppUser::pluck('DomId', 'id');

        $vehicle->load('app_users');

        return view('vehicles.edit', compact('vehicle', 'app_users'));
        
    }

    public function update(UpdateVehicleRequest $request, Vehicle $vehicle)
    {
        $vehicle->update($request->validated());
        $vehicle->app_users()->sync($request->input('app_users', []));

        return redirect()->route('vehicles.index');
    }

}