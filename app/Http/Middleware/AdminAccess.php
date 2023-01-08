<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AdminAccess
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return RedirectResponse|Response
     */
    public function handle(Request $request, Closure $next): RedirectResponse|Response
    {
        if(Auth::check() && Auth::user()->isAdmin()){
            return $next($request);
        }

        return redirect()->route('login');
    }
}
