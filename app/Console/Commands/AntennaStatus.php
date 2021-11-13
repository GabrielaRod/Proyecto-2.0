<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AntennaStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'change:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Changes the Antenna Status from Active to Inactive if it spends more than 30 minutes without reading any Tag';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $datetime = Carbon::now()->subMinutes(30)->toDateTimeString();

        $data = DB::table('livefeed')
            ->select('livefeed.location_id')
            ->orderBy('created_at', 'asc')
            ->where('created_at', '<=', $datetime)
            ->first();

        DB::table('antennas')
            ->select('antennas.Status')
            ->where('antennas.coordinate_id', $data->location_id)
            ->update(['Status' => 'INACTIVE']);

        $this->info('Successfully changed antenna id ' . $data->location_id . ' status.');
    }
}
