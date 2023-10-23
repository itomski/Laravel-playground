<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

class VehicleNotFoundException extends Exception
{
    public function __construct()
    {
        $this->message = 'Kein passendes Fahrzeug gefunden!';
    }

    public function report() {
        // Den Exception reporten z.B. in einen Logger oder Email
        //debug(['error' => 'Fahrzeug nicht gefunden!']);
        //Log::debug($this->message);
        logger()->channel('slack')->error($this->message);

    }

    public function render($request) {
        return view('exceptions.vehicle_not_found', ['message' => $this->message]);
    }
}
