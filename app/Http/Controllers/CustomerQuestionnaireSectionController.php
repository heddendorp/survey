<?php namespace Survey\Http\Controllers;

use Survey\Customer;
use Survey\Http\Requests;
use Survey\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Survey\Questionnaire;
use Survey\Section;

class CustomerQuestionnaireSectionController extends Controller {

    /**
     * Instantiate a new Controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('customerplus');
        $this->middleware('questionnairePerms');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Customer $customer
     * @param Questionnaire $questionnaire
     * @return Response
     */
	public function index(Customer $customer, Questionnaire $questionnaire)
	{
		$sections = $questionnaire->sections;
        return view('section.index')->withCustomer($customer)->withQuestionnaire($questionnaire)->withSections($sections);
	}

    /**
     * Show the form for creating a new resource.
     *
     * @param Customer $customer
     * @param Questionnaire $questionnaire
     * @return Response
     */
	public function create(Customer $customer, Questionnaire $questionnaire)
	{
		return view('section.create')->withCustomer($customer)->withQuestionnaire($questionnaire);
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param Customer $customer
     * @param Questionnaire $questionnaire
     * @param Requests\QuestionnaireRequest $request
     * @return Response
     */
	public function store(Customer $customer, Questionnaire $questionnaire, Requests\QuestionnaireRequest $request)
	{
		$section = new Section;
        $section->title = $request->get('title');
        $section->intern = $request->get('intern');
        $section->questionnaire_id = $questionnaire->id;
        $section->save();
        return redirect()->route('customer.questionnaire.section.index', [$customer, $questionnaire]);
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
     * @param Questionnaire $questionnaire
     * @param Section $section
     * @return Response
     */
	public function edit(Customer $customer, Questionnaire $questionnaire, Section $section)
	{
        return view('section.edit')->withCustomer($customer)->withQuestionnaire($questionnaire)->withSection($section);
	}

    /**
     * Update the specified resource in storage.
     *
     * @param Requests\QuestionnaireRequest $request
     * @param Customer $customer
     * @param Questionnaire $questionnaire
     * @param Section $section
     * @return Response
     */
	public function update(Requests\QuestionnaireRequest $request, Customer $customer, Questionnaire $questionnaire, Section $section)
	{
		$section->title = $request->get('title');
        $section->intern = $request->get('intern');
        $section->save();
        return redirect()->route('customer.questionnaire.section.index', [$customer, $questionnaire]);
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param Customer $customer
     * @param Questionnaire $questionnaire
     * @param Section $section
     * @return Response
     * @internal param int $id
     */
	public function destroy(Customer $customer, Questionnaire $questionnaire, Section $section)
	{
        foreach($section->questiongroups as $questiongroup)
        {
            foreach($questiongroup->questions as $question)
            {
                $question->delete();
            }
            $questiongroup->delete();
        }
		$section->delete();
        return redirect()->route('customer.questionnaire.section.index',[$customer,$questionnaire,$section]);
	}

}
