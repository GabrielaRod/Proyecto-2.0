<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MapAntennaUpdate implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $mapnotification;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($mapnotification)
    {
        $this->mapnotification = $mapnotification;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('MapLocationChannel');
    }

    public function broadcastWith()
    {

        return [
            'id' => $this->mapnotification->id,
            'Message' => $this->mapnotification->Message,
            'Read' => $this->mapnotification->Read
        ];
    }
}
