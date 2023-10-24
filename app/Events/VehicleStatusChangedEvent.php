<?php

namespace App\Events;

use App\Models\Vehicle;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VehicleStatusChangedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $vehicle;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($vehicle)
    {
        $this->vehicle = $vehicle;
    }

    public function getVehicle() : Vehicle {
        return $this->vehicle;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
