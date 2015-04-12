<?php

namespace Survey\Http\Controllers;

use Illuminate\Http\Request;
use Survey\Models\Customer;
use Survey\Models\Facility;
use Survey\Http\Requests;
use Survey\Models\Iteration;
use Survey\Models\Set;

class CustomerSetFacilityController extends Controller
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
     * @param Customer $customer
     * @param Set $set
     * @return Response
     *
     */
    public function index(Customer $customer, Set $set)
    {
        $facilities = $set->facilities;

        return view('set.facility.index')->withCustomer($customer)->withSet($set)->withFacilities($facilities);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Customer  $customer
     * @param Iteration $iteration
     *
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
     * @param Set $set
     * @param Request|Requests\FacilityRequest $request
     * @return Response
     */
    public function store(Request $request, Customer $customer, Set $set)
    {
        $facility = new Facility;
        $facility->name = $request->get('name');
        $facility->set()->associate($set);
        $facility->save();

        return redirect()->route('customer.set.facility.index', [$customer, $set]);
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
     *
     * @return Response
     *
     * @internal param int $id
     */
    public function edit(Customer $customer, Iteration $iteration, Facility $facility)
    {
        return view('facility.edit')->withCustomer($customer)->withIteration($iteration)->withFacility($facility);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Customer                 $customer
     * @param Iteration                $iteration
     * @param Facility                 $facility
     * @param Requests\FacilityRequest $request
     *
     * @return Response
     *
     * @internal param int $id
     */
    public function update(Customer $customer, Set $set, Facility $facility, Request $request)
    {
        $facility->name = $request->get('name');
        $facility->save();

        return redirect()->route('customer.set.facility.index', [$customer, $set]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Customer $customer
     * @param Set $set
     * @param Facility $facility
     * @return Response
     * @throws \Exception
     */
    public function destroy(Customer $customer, Set $set, Facility $facility)
    {
        $facility->delete();

        return redirect()->route('customer.set.facility.index', [$customer, $set]);
    }
}
