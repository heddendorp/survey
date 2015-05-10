<?php

namespace Survey\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Survey\Result;

class ResultPermissions
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
        $route = \Route::getCurrentRoute();
        //dd($route);
        $user = \Auth::user();
        if ($user->role['admin']) {
            return $next($request);
        }
        if(isset($route->parameters()['view']))
        {
            $results = Result::whereFacility($route->parameter('id'))->whereSurveyId($route->parameter('survey')->id)->get();
            foreach($results as $result)
            {
                if (!isset($user->role['results'][$result->id])) {
                    return redirect()->back()->withErrors(['page' => 'Es ist ihnen nicht gestattet diese Aktion auszuführen.']);
                }
            }
        }else{
            $uri = $request->getRequestUri();
            $pos = strripos($request->getRequestUri(), '/');
            $id = substr($uri, $pos - strlen($uri) + 1);
            if (!isset($user->role['results'][$id])) {
                return redirect()->back()->withErrors(['page' => 'Es ist ihnen nicht gestattet diese Aktion auszuführen.']);
            }
        }

        return $next($request);
    }
}
