<?php namespace Survey\Http\Controllers;

use Survey\Customer;
use Survey\Http\Requests;
use Survey\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Survey\Questionnaire;

class CustomerQuestionnaireController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('customer');
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
        return redirect()->route('customer.questionnaire.show', [$customer, $questionnaire]);
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

        return redirect()->route('customer.questionnaire.show', [$customer, $questionnaire]);
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
		$questionnaire->delete();
        return redirect()->route('customer.questionnaire.index', $customer);
	}

}
