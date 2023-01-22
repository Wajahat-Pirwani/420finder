<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckIfApproved
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
        if(Session::has('business_id')) {
            $businessId = Session::get('business_id');
            $business = Business::where('id', $businessId)->first();
            if(!$business->approve) {
                return redirect()->route('approve.failed');
            }
        }

        return $next($request);
    }
}
