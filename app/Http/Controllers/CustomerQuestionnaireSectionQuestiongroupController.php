<?php namespace Survey\Http\Controllers;

use Survey\Customer;
use Survey\Http\Requests;
use Survey\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Survey\Questionnaire;
use Survey\Section;

class CustomerQuestionnaireSectionQuestiongroupController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('customer');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Customer $customer
     * @param Questionnaire $questionnaire
     * @param Section $section
     * @return Response
     */
	public function index(Customer $customer, Questionnaire $questionnaire, Section $section)
	{
		$data['questiongroups'] = $section->questiongroups;
        $data['customer'] = $customer;
        $data['questionnaire'] = $questionnaire;
        $data['section'] = $section;
        /** @var TYPE_NAME $customer */
        return view('questiongroup.index',[$customer,$questionnaire,$section])->with($data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Customer $customer, Questionnaire $questionnaire, Section $section)
	{
        $data['customer'] = $customer;
        $data['questionnaire'] = $questionnaire;
        $data['section'] = $section;
		return view('questiongroup.create')->with($data);
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
