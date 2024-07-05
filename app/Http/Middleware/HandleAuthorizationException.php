<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Log;

class HandleAuthorizationException
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            return $next($request);
            Log::info('all good.');
        } catch (AuthorizationException $e) {
            // Redirect back with a flash message
            Log::error('Error',$e->getMessage());
            return redirect()->back()->with('error', 'You do not have permission to access this page.');
        }

    }
}
