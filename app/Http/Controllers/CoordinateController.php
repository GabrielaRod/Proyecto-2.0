<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\UpdateLocationRequest;
use App\Models\Coordinate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class CoordinateController extends Controller
{
    public function index()
    {
        //abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $coordinates = Coordinate::all();

        return view('coordinates.index', compact('coordinates'));
    }

    public function create(Coordinate $coordinate)
    {
        //abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('coordinates.create', compact('coordinate'));
    }

    public function edit(Coordinate $coordinate)
    {
        //abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('coordinates.edit', compact('coordinate'));
    }

    public function store(StoreLocationRequest $request, Coordinate $coordinate)
    {
        $coordinate->create($request->validated());

        return redirect()->route('coordinates.index');
    }

    public function show(Coordinate $coordinate)
    {
        //abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('coordinates.show', compact('coordinate'));
    }


    public function update(UpdateLocationRequest $request, Coordinate $coordinate)
    {

        $coordinate->update($request->validated());
        $coordinate->antennas()->sync($request->input('coordinate_id', []));

        return redirect()->route('coordinates.index');
    }

    public function destroy(Coordinate $coordinate)
    {
        //abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $coordinate->delete();

        return redirect()->route('coordinates.index');
    }
}
