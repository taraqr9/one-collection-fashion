<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PreventUnAuthorizedAccessCustom
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (! empty(config('app.allowed_domain'))) {
            $allowed_domains = explode(',', config('app.allowed_domain'));
            $allowed_domains = array_map('trim', $allowed_domains);
            $origin = $request->headers->get('origin');
            $origin_host = parse_url($origin)['host'] ?? null;

            if (is_null($allowed_domains) || ! in_array($origin_host, $allowed_domains, true)) {
                return response()->fail('You are not allowed to access this route!', 403);
            }
        }

        return $next($request);
    }
}
