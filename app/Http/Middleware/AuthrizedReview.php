<?php

namespace App\Http\Middleware;

use App\Models\AuthorizationReview;
use Closure;
use Illuminate\Http\Request;

class AuthrizedReview
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
        if (AuthorizationReview::first()->key ?? null == 1) {
            return $next($request);
        }

        return response()->json(['error' => 'You are not allowed access at this time, try again!'], 403);
    }
}
