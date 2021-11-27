<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Events\MapAntennaUpdate;
use Carbon\Carbon;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;

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
        $request = new Request();

        $users = DB::table('users')
            ->join('role_user', 'role_user.user_id', '=', 'users.id')
            ->select('users.email')
            ->where('role_user.role_id', '1')
            ->get();

        $location = DB::table('livefeed')  //Checks for an antenna that hasnt read any tag in the last 30 minutes.
            ->select('livefeed.location_id')
            ->orderBy('created_at', 'asc')
            ->where('created_at', '<=', $datetime)
            ->first();

        DB::table('antennas')               //Changes status to inactive to the antenna found in the previous query.
            ->select('antennas.Status')
            ->where('antennas.coordinate_id', $location->location_id)
            ->update(['Status' => 'INACTIVE']);

        $antenna = DB::table('antennas')    //Selects Location of the previously status changed antenna
            ->join('coordinates', 'coordinates.id', '=', 'antennas.coordinate_id')
            ->select('coordinates.Location')
            ->where('antennas.coordinate_id', $location->location_id)
            ->first();


        $message = 'La antena ubicada en ' . $antenna->Location . ' presenta una avería.';

        $notification = new Notification();
        $notification->Message = $message;
        $notification->Read = $request->boolean(false);

        $notification->save();

        $locationNotification = DB::table('notifications')
            ->where('notifications.id', $notification->id)
            ->select('notifications.id', 'notifications.Message', 'notifications.Read')
            ->first();


        foreach ($users as $user) {
            /* EMAIL NOTIFICATION */
            Mail::raw($message, function ($mail) use ($user) {
                $mail->from('mantenimiento@assettracker.com');
                $mail->to($user->email)
                    ->subject('Notificacion de Antena Averiada');
            });
        }

        broadcast(new MapAntennaUpdate($locationNotification));

        $this->info('Successfully changed antenna id ' . $location->location_id . ' status to Inactive.');
    }
}
