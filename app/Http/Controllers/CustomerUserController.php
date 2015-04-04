<?php

namespace Survey\Http\Controllers;

use Survey\Models\Customer;
use Survey\Http\Requests;
use Illuminate\Http\Request;
use Survey\Models\User;

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

    public function store(Customer $customer, Request $request)
    {
        $user = new User($request->only(['name', 'email', 'password']));
        $user->role = $this->makeRole($request);
        $user->customer()->associate($customer);
        $user->save();

        return redirect()->route('customer.user.index', $customer);
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
    public function update(Customer $customer, User $user, Request $request)
    {
        $user->email = $request->get('email');
        $user->name = $request->get('name');
        if ($request->has('password')) {
            $user->password = $request->get('password');
        }
        if (!$user->admin) {
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
        $post = $request->get('role');
        $role['admin'] = false;
        $role['survey_view'] = isset($post['survey.view']);
        $role['survey_create'] = isset($post['survey.create']);
        $role['survey_edit'] = isset($post['survey.edit']);
        $role['survey_delete'] = isset($post['survey.delete']);
        $role['questionnaire_view'] = isset($post['questionnaire.view']);
        $role['questionnaire_create'] = isset($post['questionnaire.create']);
        $role['questionnaire_edit'] = isset($post['questionnaire.edit']);
        $role['questionnaire_delete'] = isset($post['questionnaire.delete']);
        $role['participant_view'] = isset($post['participant.view']);
        $role['participant_create'] = isset($post['participant.create']);
        $role['participant_edit'] = isset($post['participant.edit']);
        $role['participant_delete'] = isset($post['participant.delete']);
        if ($request->has('results')) {
            $role['results'] = isset($post['results']);
        }

        return $role;
    }
}
