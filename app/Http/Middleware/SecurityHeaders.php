<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    private $unwantedHeaders = ['X-Powered-By', 'server', 'Server'];

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('Content-Security-Policy', "frame-ancestors 'none';");
        $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('Access-Control-Allow-Origin', 'SAMEORIGIN');
        $response->headers->set('Cross-Origin-Resource-Policy', 'SAMEORIGIN');
        $response->headers->set('Permissions-Policy', 'accelerometer=(), camera=(), geolocation=(), gyroscope=(), magnetometer=(), microphone=(), payment=(), usb=()');
        $response->headers->set('Access-Control-Allow-Methods', 'GET,POST,PUT,DELETE');
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type,Authorization,X-Requested-With,X-CSRF-Token');


        // $response->headers->set('X-Aspnet-Version', '4.8.1');
        // $response->headers->set('X-Powered-By', 'ASP.NET');
        // $response->headers->set('Feature-Policy', "geolocation 'self'; vibrate 'none'");
        $this->removeUnwantedHeaders($this->unwantedHeaders);

        return $response;
    }

    private function removeUnwantedHeaders($headers): void
    {
        foreach ($headers as $header) {
            header_remove($header);
        }
    }
}
