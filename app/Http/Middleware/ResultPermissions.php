<?php namespace Survey\Http\Middleware;

use Closure;

class ResultPermissions {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
        $user = \Auth::user();
        if($user->role["admin"])
            return $next($request);
        $uri = $request->getRequestUri();
        $pos = strripos($request->getRequestUri(),'/');
        $id = substr($uri, $pos - strlen($uri) + 1);
        if(!isset($user->role['results'][$id]))
            return redirect()->back()->withErrors(['page'=>'Es ist ihnen nicht gestattet diese Aktion auszuführen.']);
		return $next($request);
	}

}
