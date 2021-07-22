<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAntennaRequest;
use App\Http\Requests\UpdateAntennaRequest;
use Illuminate\Http\Request;
use App\Models\Antenna;
use App\Models\Coordinate;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class AntennaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //abort_if(Gate::denies('antenna_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $antennas = Antenna::with('coordinates')->get();

        return view('antennas.index', compact('antennas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Antenna $antenna)
    {
        //abort_if(Gate::denies('antenna_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $coordinates = Coordinate::pluck('id');

        $antenna->load('coordinates');

        return view('antennas.create', compact('antenna', 'coordinates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAntennaRequest $request, Antenna $antenna)
    {
        $antenna->create($request->validated());
        $antenna->coordinates()->sync($request->input('coordinates', []));

        return redirect()->route('antennas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Antenna $antenna)
    {
        //abort_if(Gate::denies('antenna_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('antennas.show', compact('antenna'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Antenna $antenna)
    {
        //abort_if(Gate::denies('antenna_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('antennas.edit', compact('antenna'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAntennaRequest $request, Antenna $antenna)
    {
        $antenna->update($request->validated());

        return redirect()->route('antennas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Antenna $antenna)
    {
        //abort_if(Gate::denies('antenna_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $antenna->delete();

        return redirect()->route('antennas.index');
    }
}
