<?php

namespace Survey\Http\Controllers;

use Illuminate\Http\Request;
use Survey\Models\Customer;
use Survey\Http\Requests;
use Survey\Models\Set;

class CustomerSetController extends Controller
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
     *
     * @return Response
     */
    public function index(Customer $customer)
    {
        $sets = $customer->sets;

        return view('set.index')->withCustomer($customer)->withSets($sets);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Customer                          $customer
     * @param Request|Requests\IterationRequest $request
     *
     * @return Response
     */
    public function store(Customer $customer, Request $request)
    {
        $set = new Set($request->only(['name']));
        $set->customer()->associate($customer);
        $set->save();

        return redirect()->route('customer.set.index', $customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Customer                          $customer
     * @param Set                               $set
     * @param Request|Requests\IterationRequest $request
     *
     * @return Response
     */
    public function update(Customer $customer, Set $set, Request $request)
    {
        $set->name = $request->get('name');
        $set->save();

        return redirect()->route('customer.set.index', $customer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Customer $customer
     * @param Set      $set
     *
     * @return Response
     *
     * @throws \Exception
     */
    public function destroy(Customer $customer, Set $set)
    {
        $set->delete();

        return redirect()->route('customer.set.index', $customer);
    }
}
