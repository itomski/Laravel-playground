<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PostLogger
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $wert = $request->request->get('wert');
        $request->request->set('wert', $wert += 100);

        $response = $next($request);
        logger()->info('Info von dem PostLogger');
        return $response;
    }
}
