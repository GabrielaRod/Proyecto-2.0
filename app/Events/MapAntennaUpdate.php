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

    public $maplocation;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($maplocation)
    {
        $this->maplocation = $maplocation;
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
            'Latitude' => $this->maplocation->latitude,
            'Longitude' => $this->maplocation->longitude,
            'Status' => $this->maplocation->status
        ];
    }
}
