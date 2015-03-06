<?php namespace Survey\Http\Controllers;

use Survey\Customer;
use Survey\Facility;
use Survey\Group;
use Survey\Http\Requests;
use Survey\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Survey\Iteration;

class CustomerIterationFacilityGroupController extends Controller {

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
	 * @return Response
	 */
	public function index(Customer $customer, Iteration $iteration, Facility $facility)
	{
		$groups = $facility->groups;
        return view('group.index')->withCustomer($customer)->withIteration($iteration)->withFacility($facility)->withGroups($groups);
	}

    /**
     * Show the form for creating a new resource.
     *
     * @param Customer $customer
     * @param Iteration $iteration
     * @param Facility $facility
     * @return Response
     */
	public function create(Customer $customer, Iteration $iteration, Facility $facility)
	{
        return view('group.create')->withCustomer($customer)->withIteration($iteration)->withFacility($facility);
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
	public function store(Customer $customer, Iteration $iteration, Facility $facility, Requests\FacilityRequest $request)
	{
        $group = new Group;
        $group->name = $request->get('name');
        $group->type = $request->get('type');
        $group->facility_id = $facility->id;
        $group->save();
        return redirect()->route('customer.iteration.facility.group.index', [$customer, $iteration, $facility]);
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
     * @param Group $group
     * @return Response
     * @internal param int $id
     */
	public function edit(Customer $customer, Iteration $iteration, Facility $facility, Group $group)
	{
        return view('group.edit')->withCustomer($customer)->withIteration($iteration)->withFacility($facility)->withGroup($group);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Customer $customer
     * @param Iteration $iteration
     * @param Facility $facility
     * @param Group $group
     * @param Requests\FacilityRequest $request
     * @return Response
     * @internal param int $id
     */
	public function update(Customer $customer, Iteration $iteration, Facility $facility, Group $group, Requests\FacilityRequest $request)
	{
		$group->name = $request->get('name');
        $group->type = $request->get('type');
        $group->save();
        return redirect()->route('customer.iteration.facility.group.index', [$customer, $iteration, $facility]);
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param Customer $customer
     * @param Iteration $iteration
     * @param Facility $facility
     * @param Group $group
     * @return Response
     * @internal param int $id
     */
	public function destroy(Customer $customer, Iteration $iteration, Facility $facility, Group $group)
	{
        $group->delete();
        return redirect()->route('customer.iteration.facility.group.index', [$customer, $iteration, $facility]);
	}

}
