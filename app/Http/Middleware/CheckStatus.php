<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$status): Response
    {
        if (!$request->user()) {
            return redirect()->route('login');
        }

        if (! in_array($request->user()->account_status, $status)) {
            abort(403, 'You are not authorized to access this page.');
        }

        return $next($request);
    }
}
