<?php

namespace App\Listeners;

use App\Events\VehicleStatusChangedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class VehicleStatusChangedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\VehicleStatusChangedEvent  $event
     * @return void
     */
    public function handle(VehicleStatusChangedEvent $event)
    {
        $vehicle = $event->getVehicle();

        logger()
            ->channel('daily')
            ->info('Status von '.$vehicle->registration.' wurde geändert zu '.$vehicle->status);
    }
}
