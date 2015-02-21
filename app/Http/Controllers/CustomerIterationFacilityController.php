<?php namespace Survey\Http\Controllers;

use Survey\Customer;
use Survey\Facility;
use Survey\Http\Requests;
use Survey\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Survey\Iteration;

class CustomerIterationFacilityController extends Controller {

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
     * @param Iteration $iteration
     * @return Response
     */
	public function index(Customer $customer, Iteration $iteration)
	{
        $facilities = $iteration->facilities;
		return view('facility.index')->withCustomer($customer)->withIteration($iteration)->withFacilities($facilities);
	}

    /**
     * Show the form for creating a new resource.
     *
     * @param Customer $customer
     * @param Iteration $iteration
     * @return Response
     */
	public function create(Customer $customer, Iteration $iteration)
	{
        return view('facility.create')->withCustomer($customer)->withIteration($iteration);
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param Customer $customer
     * @param Iteration $iteration
     * @param Facility $facility
     * @param Requests\FacilityRequest $request
     * @return Response
     */
	public function store(Customer $customer, Iteration $iteration, Requests\FacilityRequest $request)
	{
		$facility = new Facility;
        $facility->name = $request->get('name');
        $facility->iteration_id = $iteration->id;
        $facility->save();
        return redirect()->route('customer.iteration.facility.index', [$customer, $iteration]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
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
