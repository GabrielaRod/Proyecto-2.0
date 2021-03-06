<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MaintenanceEmail extends Mailable
{
    use Queueable;
    private $maintenanceData;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($maintenanceData)
    {
        $this->maintenanceData = $maintenanceData;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Notificacion de Mantenimiento')
            ->mailer('mantenimiento')
            ->greeting('Hola!')
            ->line($this->maintenanceData['body'])
            ->line($this->maintenanceData['maintenanceText'])
            ->line($this->maintenanceData['thankyou']);
    }

    public function build()
    {
        return (new MailMessage)
            ->subject('Notificacion de Mantenimiento')
            ->mailer('mantenimiento')
            ->greeting('Hola!')
            ->line($this->maintenanceData['body'])
            ->line($this->maintenanceData['maintenanceText'])
            ->line($this->maintenanceData['thankyou']);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
