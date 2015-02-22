<?php namespace Survey\Http\Controllers;

use Survey\Customer;
use Survey\Group;
use Survey\Http\Requests;
use Survey\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Survey\Questionnaire;
use Survey\Survey;
use Survey\Token;

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

        foreach($request->get('group') as $id=>$on)
        {
            $group = Group::find($id);
            foreach ($group->children as $child) {
                $token = new Token;
                $token->facility = $child->group->facility_id;
                $token->group = $child->group_id;
                $token->name = $child->name;
                $token->email = $child->email;
                $token->token = md5($child->name.$child->email.$child->id.time());
                $token->survey_id = $survey->id;
                $token->save();
            }
        }

        return redirect()->route('customer.survey.index', $customer);
	}

    /**
     * Display the specified resource.
     *
     * @param Customer $customer
     * @param Survey $survey
     * @return Response
     * @internal param int $id
     */
	public function show(Customer $customer, Survey $survey)
	{
		return view('survey.show')->withCustomer($customer)->withSurvey($survey);
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param Customer $customer
     * @param Survey $survey
     * @return Response
     * @internal param int $id
     */
	public function edit(Customer $customer, Survey $survey)
	{
        return view('survey.edit')->withCustomer($customer)->withSurvey($survey);
	}

    /**
     * Update the specified resource in storage.
     *
     * @param Customer $customer
     * @param Survey $survey
     * @param Requests\SurveyUpdateRequest $request
     * @return Response
     * @internal param int $id
     */
	public function update(Customer $customer, Survey $survey, Requests\SurveyUpdateRequest $request)
	{
		$survey->welcome_mail = $request->get('welcome_mail');
        $survey->remember_mail = $request->get('remember_mail');
        $survey->finish_mail = $request->get('finish_mail');
        $survey->name = $request->get('name');
        $survey->end_date =  \DateTime::createFromFormat('d.m.Y',$request->get('end_date'));
        $survey->save();

        return redirect()->route('customer.survey.index', $customer);
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param Customer $customer
     * @param Survey $survey
     * @return Response
     * @throws \Exception
     * @internal param int $id
     */
	public function destroy(Customer $customer, Survey $survey)
	{
        foreach($survey->tokens as $token)
            $token->delete();
		$survey->delete();
        return redirect()->route('customer.survey.index', $customer);
	}

    /**
     * Send begin Mails for selected Survey.
     *
     * @param Customer $customer
     * @param Survey $survey
     * @return Response
     * @internal param int $id
     */
    public function sendWelcome(Customer $customer, Survey $survey)
    {
        $text = $survey->welcome_mail;
        foreach($survey->tokens as $token)
        {
            $text = str_replace(':name', $token->name, $text);
            $key = $token->token;
            $link = route('token.key', $key);
            $link = '<a href="'.$link.'">Fragebogen</a>';
            $text = str_replace(':link',$link, $text);
            $text = nl2br($text);
            \Mail::queue('emails.welcome', ['text'=>$text], function($message) use ($customer, $token, $survey)
            {
                $message->from($customer->info_email, $customer->name);
                $message->to($token->email)->subject($survey->name);
            });
        }
        return redirect()->route('customer.survey.index', $customer);
    }

}
