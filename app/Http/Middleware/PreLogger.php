<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class PreLogger
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $val)
    {
        //$request->request->add(['wert' => 100]);
        $request->request->set('wert', 100); // Hängt einen neuen Wert an das Request
        logger()->info($val.': Bin gerade durch den Logger genaufen...');
        // Log::info('Bin gerade durch den Logger genaufen...');
        return $next($request);
    }

    public function terminate($request, $response)
    {
        $wert = $request->request->get('wert');
        logger()->info('Bin hier fertig...'.$wert);
    }
}
