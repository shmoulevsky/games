<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class CheckAccessPanel extends Middleware
{
    // Override handle method
    public function handle($request, Closure $next, ...$guards)
    {
        if (!Auth::check() || !$request->user()->access_panel) {
            return response()->json(['error'=>'Unauthorized for access panel'],400);
        }
        return $next($request);
    }

}
