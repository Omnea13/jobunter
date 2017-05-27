<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Auth;

class ChecKCompanyRenew
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
        /*
            check company [expire_date] if greater than current time or not
            if greater than current time => deactive this company and redirect 
            him to renew page payment with [company] information
        */
        $currentTime = strtotime(Carbon::now());
        $expire_date = Auth::user()->company->expire_date;
        if($expire_date <= $currentTime) {
            return redirect('renew');
        }
        return $next($request);
    }
}
