<?php namespace Survey\Http\Controllers;

use Survey\Customer;
use Survey\Group;
use Survey\Http\Requests;
use Survey\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Survey\Questionnaire;
use Survey\Survey;

class CustomerSurveyController extends Controller {

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
     * @param Customer $customer
     * @param Requests\SurveyRequest $request
     * @return Response
     */
	public function store(Customer $customer, Requests\SurveyRequest $request)
	{
        foreach($request->get('group') as $id=>$on)
        {
            $group = Group::find($id);
            $groups[$group->id] = $group->toArray();
            $facilities[$group->facility->id] = $group->facility->toArray();
            foreach ($group->children as $child) {
                $members[$child->id] = $child->toArray();
            }

        }
        $questionnaire = Questionnaire::find($request->get('questionnaire'));
        foreach($questionnaire->sections as $section)
        {
            $questions[$section->id] = $section->toArray();
            $questiongroups = $section->questiongroups->sortBy('order');
            foreach ($questiongroups as $questiongroup)
            {
                $questions[$section->id]['questiongroups'][$questiongroup->id] = $questiongroup->toArray();
                foreach ($questiongroup->questions as $question)
                {
                    $questions[$section->id]['questiongroups'][$questiongroup->id]['questions'][$question->id] = $question->toArray();
                }
            }
        }
        $survey = new Survey;
        $survey->members = $members;
        $survey->groups = $groups;
        $survey->questions = $questions;
        $survey->facilities = $facilities;
        $survey->welcome_mail = $questionnaire->welcome_mail;
        $survey->remember_mail = $questionnaire->remember_mail;
        $survey->finish_mail = $questionnaire->finish_mail;
        $survey->end_date = \DateTime::createFromFormat('d.m.Y',$request->get('end_date'));
        $survey->questionnaire = $questionnaire->title;
        $survey->customer_id = $customer->id;
        $survey->name = $request->get('name');
        $survey->save();

        return redirect()->route('customer.survey.index', $customer);
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
