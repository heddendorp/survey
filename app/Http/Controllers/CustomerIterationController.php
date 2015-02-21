<?php namespace Survey\Http\Controllers;

use Survey\Customer;
use Survey\Http\Requests;
use Survey\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Survey\Iteration;

class CustomerIterationController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @param Customer $customer
     * @return Response
     */
	public function index(Customer $customer)
	{
        $iterations = $customer->iterations;
        return view('iteration.index')->withCustomer($customer)->withIterations($iterations);
	}

    /**
     * Show the form for creating a new resource.
     *
     * @param Customer $customer
     * @return Response
     */
	public function create(Customer $customer)
	{
		return view('iteration.create')->withCustomer($customer);
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param Customer $customer
     * @param Requests\IterationRequest $request
     * @return Response
     */
	public function store(Customer $customer, Requests\IterationRequest $request)
	{
		$iteration = new Iteration;
        $iteration->customer_id = $customer->id;
        $iteration->description = $request->get('description');
        $iteration->save();
        return redirect()->route('customer.iteration.index', $customer);
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
     * @param Iteration $iteration
     * @return Response
     * @internal param int $id
     */
	public function edit(Customer $customer, Iteration $iteration)
	{
		return view('iteration.edit')->withCustomer($customer)->withIteration($iteration);
	}

    /**
     * Update the specified resource in storage.
     *
     * @param Customer $customer
     * @param Iteration $iteration
     * @param Requests\IterationRequest $request
     * @return Response
     * @internal param int $id
     */
	public function update(Customer $customer, Iteration $iteration, Requests\IterationRequest $request)
	{
		$iteration->description = $request->get('description');
        $iteration->save();
        return redirect()->route('customer.iteration.index', $customer);
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param Customer $customer
     * @param Iteration $iteration
     * @return Response
     * @internal param int $id
     */
	public function destroy(Customer $customer, Iteration $iteration)
	{
		$iteration->delete();
        return redirect()->route('customer.iteration.index', $customer);
	}

}
