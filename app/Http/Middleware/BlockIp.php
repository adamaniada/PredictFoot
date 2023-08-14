<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BlockIp
{
    /**
     * IP addresses to block.
     *
     * @var array
     */
    private $blockedIps = [
        // '127.0.0.1',
        // '192.168.1.10',
        // Ajoutez d'autres adresses IP à bloquer ici
    ];

    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $clientIp = $request->ip();

        if (in_array($clientIp, $this->blockedIps)) {
            abort(403, "Accès interdit. Adresse IP bloquée : $clientIp");
        }

        return $next($request);
    }
}
