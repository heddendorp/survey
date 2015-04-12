<?php

namespace Survey\Http\Controllers;

use Illuminate\Http\Request;
use Survey\Models\Customer;
use Survey\Models\Facility;
use Survey\Models\Group;
use Survey\Http\Requests;
use Survey\Models\Set;

class CustomerSetFacilityGroupController extends Controller
{
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
     * @param Customer  $customer
     * @param Iteration $iteration
     * @param Facility  $facility
     *
     * @return Response
     */
    public function index(Customer $customer, Set $set, Facility $facility)
    {
        $groups = $facility->groups;

        return view('set.facility.group.index')->withCustomer($customer)->withSet($set)->withFacility($facility)->withGroups($groups);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Customer  $customer
     * @param Iteration $iteration
     * @param Facility  $facility
     *
     * @return Response
     */
    public function create(Customer $customer, Set $set, Facility $facility)
    {
        return view('set.facility.group.create')->withCustomer($customer)->withSet($set)->withFacility($facility);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Customer                 $customer
     * @param Iteration                $iteration
     * @param Facility                 $facility
     * @param Requests\FacilityRequest $request
     *
     * @return Response
     */
    public function store(Customer $customer, Set $set, Facility $facility, Request $request)
    {
        $group = new Group();
        $group->name = $request->get('name');
        $group->type = $request->get('type');
        //$group->facility()->associate($facility);
        $group->facility_id = $facility->id;
        $group->save();

        return redirect()->route('customer.set.facility.group.index', [$customer, $set, $facility]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        //not used
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Customer  $customer
     * @param Iteration $iteration
     * @param Facility  $facility
     * @param Group     $group
     *
     * @return Response
     *
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
     * @param Set $set
     * @param Facility $facility
     * @param Group $group
     * @param Request|Requests\FacilityRequest $request
     * @return Response
     * @internal param Iteration $iteration
     * @internal param int $id
     */
    public function update(Customer $customer, Set $set, Facility $facility, Group $group, Request $request)
    {
        $group->name = $request->get('name');
        $group->type = $request->get('type');
        $group->save();

        return redirect()->route('customer.set.facility.group.index', [$customer, $set, $facility]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Customer  $customer
     * @param Iteration $iteration
     * @param Facility  $facility
     * @param Group     $group
     *
     * @return Response
     *
     * @internal param int $id
     */
    public function destroy(Customer $customer, Set $set, Facility $facility, Group $group)
    {
        $group->delete();

        return redirect()->route('customer.set.facility.group.index', [$customer, $set, $facility]);
    }
}
