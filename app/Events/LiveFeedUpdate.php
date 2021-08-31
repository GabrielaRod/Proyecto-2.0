<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LiveFeedUpdate implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $livefeed;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($livefeed)
    {
        $this->livefeed = $livefeed;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('new-entry');
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->livefeed->id,
            'Data' => $this->livefeed->data,
            'location_id' => $this->livefeed->location_id
        ];
    }
}
