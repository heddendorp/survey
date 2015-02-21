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
     * @param Customer $customer
     * @param Iteration $iteration
     * @param Facility $facility
     * @param Group $group
     * @return Response
     */
	public function multi(Customer $customer, Iteration $iteration, Facility $facility, Group $group)
	{
        return view('child.multi')->withCustomer($customer)->withIteration($iteration)->withFacility($facility)->withGroup($group);
	}

	/**
	 * Store many newly created resources in storage.
	 *
	 * @return Response
	 */
	public function storemany(Customer $customer, Iteration $iteration, Facility $facility, Group $group, Request $request)
	{
        if(!$request->hasFile('sheet'))
            return redirect()->route('customer.iteration.facility.group.child.multi', [$customer, $iteration, $facility, $group])->withErrors(['sheet'=>'Es muss eine Tabelle ausgewählt werden.']);
		$file = $request->file('sheet');
        //dd($file->getClientOriginalExtension());
        if($file->getClientOriginalExtension() !== 'csv')
            return redirect()->route('customer.iteration.facility.group.child.multi', [$customer, $iteration, $facility, $group])->withErrors(['sheet'=>'Tabelle muss im .csv Format gespeichert werden.']);
        dd(file_get_contents($file));
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
     * @param Child $child
     * @return Response
     * @internal param int $id
     */
	public function edit(Customer $customer, Iteration $iteration, Facility $facility, Group $group, Child $child)
	{
        return view('child.edit')->withCustomer($customer)->withIteration($iteration)->withFacility($facility)->withGroup($group)->withChild($child);
	}

    /**
     * Update the specified resource in storage.
     *
     * @param Customer $customer
     * @param Iteration $iteration
     * @param Facility $facility
     * @param Group $group
     * @param Child $child
     * @param Requests\ChildRequest $request
     * @return Response
     * @internal param int $id
     */
	public function update(Customer $customer, Iteration $iteration, Facility $facility, Group $group, Child $child, Requests\ChildRequest $request)
	{
		$child->name = $request->get('name');
        $child->email = $request->get('email');
        $child->save();

        return redirect()->route('customer.iteration.facility.group.child.index', [$customer, $iteration, $facility, $group]);
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param Customer $customer
     * @param Iteration $iteration
     * @param Facility $facility
     * @param Group $group
     * @param Child $child
     * @return Response
     * @internal param int $id
     */
	public function destroy(Customer $customer, Iteration $iteration, Facility $facility, Group $group, Child $child)
	{
        $child->delete();
        return redirect()->route('customer.iteration.facility.group.child.index', [$customer, $iteration, $facility, $group]);
	}

}
