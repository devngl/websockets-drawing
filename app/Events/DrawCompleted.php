<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DrawCompleted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets;

    /**
     * @var string
     */
    private $room;
    public $shape;

    /**
     * Create a new event instance.
     *
     * @param string $room
     * @param $shape
     */
    public function __construct(string $room, $shape)
    {
        $this->room = $room;
        $this->shape = $shape;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return PresenceChannel
     */
    public function broadcastOn()
    {
        return new PresenceChannel('room.' . $this->room);
    }
}
