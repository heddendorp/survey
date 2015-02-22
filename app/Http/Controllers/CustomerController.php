<?php namespace Survey\Http\Controllers;

use Survey\Customer;
use Survey\Http\Requests;
use Survey\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Survey\User;

class CustomerController extends Controller {

    /**
     * Instantiate a new Controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['create','store']]);
        $this->middleware('customer',['except'=>['create','store', 'edit', 'update']]);
        $this->middleware('customerplus',['only'=>['edit','update']]);
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

        return redirect()->route('customer.show',$customer);
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
     * @param Customer $customer
     * @return Response
     */
	public function edit(Customer $customer)
	{
		return view('customer.edit')->withCustomer($customer);
	}

    /**
     * Update the specified resource in storage.
     *
     * @param Requests\CustomerUpdateRequest $request
     * @param Customer $customer
     * @return Response
     * @internal param int $id
     */
	public function update(Requests\CustomerUpdateRequest $request, Customer $customer)
	{
		$customer->name = $request->get('name');
        $customer->info_email = $request->get('info_email');
        $customer->logo = $request->get('logo');
        $customer->save();
        return redirect()->route('customer.show', $customer);
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
