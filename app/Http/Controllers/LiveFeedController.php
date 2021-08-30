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
        abort_if(Gate::denies('antenna_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $livefeed = LiveFeed::all();

        return view('livefeed.index', compact('livefeed'));
    }
}
