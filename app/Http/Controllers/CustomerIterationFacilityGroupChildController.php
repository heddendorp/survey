<?php namespace Survey\Http\Controllers;

use Survey\Child;
use Survey\Customer;
use Survey\Facility;
use Survey\Group;
use Survey\Http\Requests;
use Survey\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Survey\Iteration;

class CustomerIterationFacilityGroupChildController extends Controller {

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
	public function index(Customer $customer, Iteration $iteration, Facility $facility, Group $group)
	{
		$children = $group->children;
        return view('child.index')->withCustomer($customer)->withIteration($iteration)->withFacility($facility)->withGroup($group)->withChildren($children);
	}

    /**
     * Show the form for creating a new resource.
     *
     * @param Customer $customer
     * @param Iteration $iteration
     * @param Facility $facility
     * @param Group $group
     * @return Response
     */
	public function create(Customer $customer, Iteration $iteration, Facility $facility, Group $group)
	{
        return view('child.create')->withCustomer($customer)->withIteration($iteration)->withFacility($facility)->withGroup($group);
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param Customer $customer
     * @param Iteration $iteration
     * @param Facility $facility
     * @param Group $group
     * @param Requests\ChildRequest $request
     * @return Response
     */
	public function store(Customer $customer, Iteration $iteration, Facility $facility, Group $group, Requests\ChildRequest $request)
	{
		$child = new Child;
        $child->name = $request->get('name');
        $child->email = $request->get('email');
        $child->group_id = $group->id;
        $child->save();

        return redirect()->route('customer.iteration.facility.group.child.index', [$customer, $iteration, $facility, $group]);
	}

    /**
	 * Show the form for creating many new resources.
	 *
	 * @return Response
	 */
	public function multi()
	{
		//
	}

	/**
	 * Store many newly created resources in storage.
	 *
	 * @return Response
	 */
	public function storemany()
	{
		//
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
