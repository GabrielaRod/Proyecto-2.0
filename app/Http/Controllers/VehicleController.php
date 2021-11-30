<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateVehicleRequest;
use App\Http\Requests\StoreVehicleRequest;
use App\Models\Vehicle;
use App\Models\AppUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class VehicleController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        //$vehicles = Vehicle::all();
        $vehicles = Vehicle::with('app_users')->get();

        return view('vehicles.index', compact('vehicles'));
    }



    public function show(Vehicle $vehicle)
    {
        $app_users = AppUser::pluck('DomID', 'FirstName', 'LastName');

        $vehicle->load('app_users');

        return view('vehicles.show', compact('vehicle', 'app_users'));
    }

    public function store(StoreVehicleRequest $request)
    {
        $vehicle = Vehicle::create($request->validated());
        $vehicle->app_users()->sync($request->input('app_user_id', []));

        return redirect()->route('vehicles.index');
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
