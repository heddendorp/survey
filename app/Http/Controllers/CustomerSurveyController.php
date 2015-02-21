<?php namespace Survey\Http\Controllers;

use Survey\Customer;
use Survey\Http\Requests;
use Survey\Http\Controllers\Controller;

use Illuminate\Http\Request;

class CustomerSurveyController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @param Customer $customer
     * @return Response
     */
	public function index(Customer $customer)
	{
		$surveys = $customer->surveys;
        return view('survey.index')->withCustomer($customer)->withSurveys($surveys);
	}

    /**
     * Show the form for creating a new resource.
     *
     * @param Customer $customer
     * @return Response
     */
	public function create(Customer $customer)
	{
		return view('survey.create')->withCustomer($customer);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
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
