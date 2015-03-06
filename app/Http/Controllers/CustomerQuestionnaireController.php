<?php namespace Survey\Http\Controllers;

use Survey\Customer;
use Survey\Http\Requests;
use Survey\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Survey\Question;
use Survey\Questiongroup;
use Survey\Questionnaire;
use Survey\Section;

class CustomerQuestionnaireController extends Controller {

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
		$questionnaires = $customer->questionnaires;
        return view('questionnaire.index')->withCustomer($customer)->withQuestionnaires($questionnaires);
	}

    /**
     * Show the form for creating a new resource.
     *
     * @param Customer $customer
     * @return Response
     */
	public function create(Customer $customer)
	{
		return view('questionnaire.create')->withCustomer($customer);
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param Requests\QuestionnaireRequest $request
     * @param Customer $customer
     * @return Response
     */
	public function store(Requests\QuestionnaireRequest $request, Customer $customer)
	{
		$questionnaire = new Questionnaire;
        $questionnaire->customer_id = $customer->id;
        $questionnaire->title = $request->get('title');
        $questionnaire->intern = $request->get('intern');
        $questionnaire->save();
        return redirect()->route('customer.questionnaire.index', [$customer]);
	}

    /**
     * Display the specified resource.
     *
     * @return Response
     */
	public function show()
	{
		// not used
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param Customer $customer
     * @param Questionnaire $questionnaire
     * @return Response
     * @internal param int $id
     */
	public function edit(Customer $customer, Questionnaire $questionnaire)
	{
		return view('questionnaire.edit')->withCustomer($customer)->withQuestionnaire($questionnaire);
	}

    /**
     * Update the specified resource in storage.
     *
     * @param Requests\QuestionnaireRequest $request
     * @param Customer $customer
     * @param Questionnaire $questionnaire
     * @return Response
     * @internal param int $id
     */
	public function update(Requests\QuestionnaireRequest $request, Customer $customer, Questionnaire $questionnaire)
	{
		$questionnaire->title = $request->get('title');
        $questionnaire->intern = $request->get('intern');
        $questionnaire->welcome_mail = $request->get('welcome_mail');
        $questionnaire->remember_mail = $request->get('remember_mail');
        $questionnaire->finish_mail = $request->get('finish_mail');
        $questionnaire->save();

        return redirect()->route('customer.questionnaire.index', [$customer]);
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param Customer $customer
     * @param Questionnaire $questionnaire
     * @return Response
     * @throws \Exception
     */
	public function destroy(Customer $customer, Questionnaire $questionnaire)
	{
        foreach($questionnaire->sections as $section)
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
        }
        $questionnaire->delete();
        return redirect()->route('customer.questionnaire.index', $customer);
	}

    /**
     * Duplicate a Questionnaire.
     *
     * @param Customer $customer
     * @param Questionnaire $questionnaire
     * @return Response
     * @internal param int $id
     */
    public function duplicate(Customer $customer, Questionnaire $questionnaire)
    {
        $newQuestionnaire = new Questionnaire;

        $newQuestionnaire->title = $questionnaire->title;
        $newQuestionnaire->intern = $questionnaire->intern."-Kopie";
        $newQuestionnaire->customer_id = $customer->id;
        $newQuestionnaire->welcome_mail = $questionnaire->welcome_mail;
        $newQuestionnaire->remember_mail = $questionnaire->remember_mail;
        $newQuestionnaire->finish_mail = $questionnaire->finish_mail;
        $newQuestionnaire->save();

        foreach($questionnaire->sections as $section)
        {
            $newsection = new Section;
            $newsection->questionnaire_id = $newQuestionnaire->id;
            $newsection->title = $section->title;
            $newsection->intern = $section->intern;
            $newsection->save();


            foreach($section->questiongroups as $questiongroup)
            {
                $newquestiongroup = new Questiongroup;
                $newquestiongroup->section_id = $newsection->id;
                $newquestiongroup->type = $questiongroup->type;
                $newquestiongroup->order = $questiongroup->order;
                $newquestiongroup->condition = $questiongroup->condition;
                $newquestiongroup->heading = $questiongroup->heading;
                $newquestiongroup->save();

                foreach($questiongroup->questions as $question)
                {
                    $newquestion = new Question;
                    $newquestion->questiongroup_id = $newquestiongroup->id;
                    $newquestion->content = $question->content;
                    $newquestion->save();
                }
            }
        }

        return redirect()->route('customer.questionnaire.index', [$customer]);
    }

}
