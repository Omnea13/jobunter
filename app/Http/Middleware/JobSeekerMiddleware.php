<?php

namespace App\Http\Middleware;

use Closure;

class JobSeekerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (\Auth::user()->type == 'jobseeker') {
            return $next($request);
        }
        return redirect('/');
    }
}
