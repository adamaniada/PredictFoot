<?php

namespace App\Http\Middleware;

use Closure;
use Torann\GeoIP\Facades\GeoIP;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BlockIpByCountry
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $blockedCountries = ['US', 'GB']; // Remplacez par les codes ISO 3166-1 alpha-2 des pays que vous voulez bloquer

        $ip = $request->ip();
        $country = GeoIP::getLocation($ip)->getAttribute('iso_code');

        if (in_array($country, $blockedCountries)) {
            return response('Accès interdit depuis ce pays.', 403);
        }

        return $next($request);
    }
}
