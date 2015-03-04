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
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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
