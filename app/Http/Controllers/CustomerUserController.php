<?php namespace Survey\Http\Controllers;

use Survey\Customer;
use Survey\Http\Requests;
use Survey\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Survey\User;

class CustomerUserController extends Controller {

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
     * @return Response
     */
	public function create(Customer $cutomer)
	{
		return view('user.create')->withCustomer($cutomer);
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param Customer $customer
     * @param Requests\UserStoreRequest $request
     * @return Response
     */
	public function store(Customer $customer, Requests\UserStoreRequest $request)
	{
        $input = $request->all();
        $user = new User;
        $user->username = $input['username'];
        $user->password = bcrypt($input['password']);
        $user->email = $input['email'];
        $user->customer_id = $customer->id;
        $user->save();

        return redirect()->route('customer.user.index', $customer);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
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
     * @param User $user
     * @return Response
     * @internal param int $id
     */
	public function edit(Customer $customer, User $user)
	{
		return view('user.edit')->withUser($user)->withCustomer($customer);
	}

    /**
     * Update the specified resource in storage.
     *
     * @param Customer $customer
     * @param User $user
     * @param Requests\UserStoreRequest $request
     * @return Response
     * @internal param int $id
     */
	public function update(Customer $customer, User $user, Requests\UserStoreRequest $request)
	{
		$user->email = $request->get('email');
        $user->username = $request->get('username');
        if($user->password != $request->get('password'))
            $user->password = bcrypt($request->get('password'));
        if($user->role != 'admin')
        {
            if($request->has('survey.view'))
                $role['survey.view'] = true;
            if($request->has('survey.create'))
                $role['survey.create'] = true;
            if($request->has('survey.edit'))
                $role['survey.edit'] = true;
            if($request->has('survey.delete'))
                $role['survey.delete'] = true;
            if($request->has('questionnaire.view'))
                $role['questionnaire.view'] = true;
            if($request->has('questionnaire.create'))
                $role['questionnaire.create'] = true;
            if($request->has('questionnaire.edit'))
                $role['questionnaire.edit'] = true;
            if($request->has('questionnaire.delete'))
                $role['questionnaire.delete'] = true;
            if($request->has('participant.view'))
                $role['participant.view'] = true;
            if($request->has('participant.create'))
                $role['participant.create'] = true;
            if($request->has('participant.edit'))
                $role['participant.edit'] = true;
            if($request->has('participant.delete'))
                $role['participant.delete'] = true;
            if($request->has('results'))
            {
                $role['results'] = $request->get('results');
            }
            $user->role = $role;
        }

        $user->save();
        return redirect()->route('customer.user.index', $customer);
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param Customer $customer
     * @param User $user
     * @return Response
     * @throws \Exception
     */
	public function destroy(Customer $customer, User $user)
	{
        $user->delete();
        return redirect()->route('customer.user.index', $customer);
	}

}
