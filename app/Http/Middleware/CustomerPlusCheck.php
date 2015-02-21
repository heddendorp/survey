<?php namespace Survey\Http\Middleware;

use Closure;

class CustomerPlusCheck {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
        $customer_id = $request->user()->customer->id;
        //dd('/customer/'.$customer_id.'*');
        if($request->is('customer/'.$customer_id.'/*'))
            return $next($request);
        return redirect('customer/'.$customer_id, 401);
	}

}
