<?php namespace Survey\Http\Controllers;

use Survey\Customer;
use Survey\Http\Requests;
use Survey\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Survey\User;

class CustomerController extends Controller {


    /**
     * Instantiate a new UserController instance.
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['create','store']]);
        $this->middleware('customer',['except'=>['create','store']]);
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('customer.create');
	}

    /**
     * Store a newly created resource in storage.
     *
     *
     * @param Requests\CustomerStoreRequest $request
     * @return Response
     */
	public function store(Requests\CustomerStoreRequest $request)
	{
		$input = $request->all();
        $customer = new Customer;
        $customer->name = $input['name'];
        $customer->info_email = $input['info_email'];
        $customer->save();

        $user = new User;
        $user->username = $input['username'];
        $user->email = $input['email'];
        $user->password = bcrypt($input['password']);
        $user->customer_id = $customer->id;
        $user->save();

        return redirect('customer/'.$customer->id);
	}

    /**
     * Display the specified resource.
     *
     * @param Customer $customer
     * @return Response
     */
	public function show(Customer $customer)
	{
        //dd($customer);
		return view('customer.show')->withCustomer($customer);
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
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
