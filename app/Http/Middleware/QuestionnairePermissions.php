<?php

namespace Survey\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class QuestionnairePermissions
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
            if (!$user->role['questionnaire.create']) {
                return redirect()->back()->withErrors(['page' => 'Es ist ihnen nicht gestattet diese Aktion auszuführen.']);
            }
            break;
        case 'PATCH':
            if (!$user->role['questionnaire.edit']) {
                return redirect()->back()->withErrors(['page' => 'Es ist ihnen nicht gestattet diese Aktion auszuführen.']);
            }
            break;
        case 'DELETE':
            if (!$user->role['questionnaire.delete']) {
                return redirect()->back()->withErrors(['page' => 'Es ist ihnen nicht gestattet diese Aktion auszuführen.']);
            }
            break;
        default:
            if (!$user->role['questionnaire.view']) {
                return redirect()->back()->withErrors(['page' => 'Es ist ihnen nicht gestattet diese Aktion auszuführen.']);
            }
            break;
    }

        return $next($request);
    }
}
