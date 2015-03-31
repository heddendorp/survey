<?php

namespace Survey\Http\Controllers;

use Survey\Customer;
use Survey\Http\Requests;
use Illuminate\Http\Request;
use Survey\User;

class CustomerUserController extends Controller
{
    /**
     * Instantiate a new Controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('customerplus');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Customer $customer
     *
     * @return Response
     */
    public function index(Customer $customer)
    {
        $users = $customer->users;

        return view('user.index')->withCustomer($customer)->withUsers($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Customer $cutomer
     *
     * @return Response
     */
    public function create(Customer $cutomer)
    {
        return view('user.create')->withCustomer($cutomer);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Customer                  $customer
     * @param Requests\UserStoreRequest $request
     *
     * @return Response
     */
    public function store(Customer $customer, Requests\UserStoreRequest $request)
    {
        $input = $request->all();
        $user = new User();
        $user->username = $input['username'];
        $user->password = bcrypt($input['password']);
        $user->email = $input['email'];
        $user->customer_id = $customer->id;
        $user->role = $this->makeRole($request);
        $user->save();

        return redirect()->route('customer.user.index', $customer);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        //not used
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Customer $customer
     * @param User     $user
     *
     * @return Response
     *
     * @internal param int $id
     */
    public function edit(Customer $customer, User $user)
    {
        return view('user.edit')->withUser($user)->withCustomer($customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Customer                  $customer
     * @param User                      $user
     * @param Requests\UserStoreRequest $request
     *
     * @return Response
     *
     * @internal param int $id
     */
    public function update(Customer $customer, User $user, Requests\UserStoreRequest $request)
    {
        $user->email = $request->get('email');
        $user->username = $request->get('username');
        if ($user->password != $request->get('password')) {
            $user->password = bcrypt($request->get('password'));
        }
        if (!$user->role['admin']) {
            $user->role = $this->makeRole($request);
        }

        $user->save();

        return redirect()->route('customer.user.index', $customer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Customer $customer
     * @param User     $user
     *
     * @return Response
     *
     * @throws \Exception
     */
    public function destroy(Customer $customer, User $user)
    {
        $user->delete();

        return redirect()->route('customer.user.index', $customer);
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    private function makeRole(Request $request)
    {
        $role['admin'] = false;
        $role['survey.view'] = $request->has('survey_view');
        $role['survey.create'] = $request->has('survey_create');
        $role['survey.edit'] = $request->has('survey_edit');
        $role['survey.delete'] = $request->has('survey_delete');
        $role['questionnaire.view'] = $request->has('questionnaire_view');
        $role['questionnaire.create'] = $request->has('questionnaire_create');
        $role['questionnaire.edit'] = $request->has('questionnaire_edit');
        $role['questionnaire.delete'] = $request->has('questionnaire_delete');
        $role['participant.view'] = $request->has('participant_view');
        $role['participant.create'] = $request->has('participant_create');
        $role['participant.edit'] = $request->has('participant_edit');
        $role['participant.delete'] = $request->has('participant_delete');
        if ($request->has('results')) {
            $role['results'] = $request->get('results');
        }

        return $role;
    }
}
