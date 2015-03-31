<?php namespace Survey\Http\Controllers;

use Survey\Customer;
use Survey\Facility;
use Survey\Http\Requests;
use Survey\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Survey\Iteration;
use Symfony\Component\Finder\Tests\FakeAdapter\FailingAdapter;

class CustomerIterationFacilityController extends Controller {

    /**
     * Instantiate a new Controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('customerplus');
        $this->middleware('participantPerms');
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
	 * @param Requests\FacilityRequest $request
	 * @return Response
	 * @internal param Facility $facility
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
		//not used
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param Customer $customer
     * @param Iteration $iteration
     * @param Facility $facility
     * @return Response
     * @internal param int $id
     */
	public function edit(Customer $customer, Iteration $iteration, Facility $facility)
	{
        return view('facility.edit')->withCustomer($customer)->withIteration($iteration)->withFacility($facility);
	}

    /**
     * Update the specified resource in storage.
     *
     * @param Customer $customer
     * @param Iteration $iteration
     * @param Facility $facility
     * @param Requests\FacilityRequest $request
     * @return Response
     * @internal param int $id
     */
	public function update(Customer $customer, Iteration $iteration, Facility $facility, Requests\FacilityRequest $request)
	{
		$facility->name = $request->get('name');
        $facility->save();
        return redirect()->route('customer.iteration.facility.index', [$customer, $iteration]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param Customer $customer
	 * @param Iteration $iteration
	 * @param Facility $facility
	 * @return Response
	 * @throws \Exception
	 * @internal param int $id
	 */
	public function destroy(Customer $customer, Iteration $iteration, Facility $facility)
	{
		$facility->delete();
        return redirect()->route('customer.iteration.facility.index', [$customer, $iteration]);
	}

}
