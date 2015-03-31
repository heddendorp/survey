<?php

namespace Survey\Http\Controllers;

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
        return view('app.welcome');
    }

    public function login()
    {
        return view('app.login');
    }

    public function authenticate(LoginFormRequest $request)
    {
        if (\Auth::attempt($request->except(['_token', 'remember'], $request->only(['remember'])))) {
            $customer = \Auth::user()->customer;

            return redirect()->route('customer.show', $customer);
        }

        return redirect('login')->withErrors(['login' => 'Benutzername oder Passwort sind falsch.']);
    }

    public function logout()
    {
        \Auth::logout();

        return redirect('/');
    }
}
