<?php

namespace Survey\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Survey\Http\Requests\LoginFormRequest;

class WelcomeController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Welcome Controller
    |--------------------------------------------------------------------------
    |
    | This controller renders the "marketing page" for the application and
    | is configured to only allow guests. Like most of the other sample
    | controllers, you are free to modify or remove it as you desire.
    |
    */

    /**
     * Instantiate a new UserController instance.
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['authenticate', 'logout']]);
    }

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function index()
    {
        return view('util.welcome');
    }

    public function login()
    {
        return view('util.login');
    }

    public function authenticate(LoginFormRequest $request)
    {
        if (Auth::attempt($request->only(['email', 'password']), $request->get('remember'))) {
            $customer = Auth::user()->customer;
            return redirect()->route('customer.show', $customer);
        }
        return redirect()->action('WelcomeController@login')->withErrors(['login' => 'Benutzername oder Passwort sind falsch.']);
    }

    public function logout()
    {
        \Auth::logout();

        return redirect('/');
    }
}
