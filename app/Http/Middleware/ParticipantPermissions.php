<?php

namespace Survey\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ParticipantPermissions
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
        $user = \Auth::user();
        if ($user->role['admin']) {
            return $next($request);
        }
        switch ($request->method()) {
            case 'POST':
                if (!$user->role['participant.create']) {
                    return redirect()->back()->withErrors(['page' => 'Es ist ihnen nicht gestattet diese Aktion auszuführen.']);
                }
                break;
            case 'PATCH':
                if (!$user->role['participant.edit']) {
                    return redirect()->back()->withErrors(['page' => 'Es ist ihnen nicht gestattet diese Aktion auszuführen.']);
                }
                break;
            case 'DELETE':
                if (!$user->role['participant.delete']) {
                    return redirect()->back()->withErrors(['page' => 'Es ist ihnen nicht gestattet diese Aktion auszuführen.']);
                }
                break;
            default:
                if (!$user->role['participant.view']) {
                    return redirect()->back()->withErrors(['page' => 'Es ist ihnen nicht gestattet diese Aktion auszuführen.']);
                }
                break;
        }

        return $next($request);
    }
}
