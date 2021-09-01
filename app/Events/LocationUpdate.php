<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LocationUpdate implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $location;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($location)
    {
        $this->location = $location;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('LocationChannel');
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->location->id,
            'Location' => $this->location->Location,
            'TagID' => $this->location->TagID,
            'Latitude' => $this->location->Latitude,
            'Longitude' => $this->location->Longitude
        ];
    }
}
