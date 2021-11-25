<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Models\AppUser;
use App\Notifications\MaintenanceEmail;

class EmailNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:yearly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Respectively send a yearly reminder to the users to check for their beacons battery for maintenance';

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
        $message = 'Recuerde hacer su mantenimiento de rutina, reemplace la batería de su rastreador para evitar interrupciones en su servicio.

       Gracias!
       El Equipo de AssetTracker!';


        $users = AppUser::all();

        /*
        $maintenanceData = [
            'body' => 'Recibiste una notificacion de mantenimiento',
            'maintenanceText' => 'Recuerde hacer su mantenimiento de rutina, reemplace la batería de su rastreador para evitar interrupciones en su servicio.',
            'thankyou' => 'Tienes 30 dias para hacer tu mantenimiento, de lo contrario no nos hacemos responsables por la interrupccion de su servicio'
        ];
        */

        foreach ($users as $user) {

            Mail::raw($message, function ($mail) use ($user) {
                $mail->from('mantenimiento@assettracker.com');
                $mail->to($user->Email)
                    ->subject('Recordatorio de Mantenimiento');
            });
        }

        $this->info('Successfully sent maintenance email to users.');
    }
}
