<?php

namespace Survey\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CustomerCheck
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $customer_id = $request->user()->customer->id;
        //dd('/customer/'.$customer_id.'*');
        if ($request->is('customer/'.$customer_id)) {
            return $next($request);
        }

        return redirect('customer/'.$customer_id, 401);
    }
}
