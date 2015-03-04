<?php namespace Survey\Http\Controllers;

use Survey\Customer;
use Survey\Http\Requests;
use Survey\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Survey\Question;
use Survey\Questiongroup;
use Survey\Questionnaire;
use Survey\Section;

class CustomerQuestionnaireSectionQuestiongroupController extends Controller {

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
     * @param Questionnaire $questionnaire
     * @param Section $section
     * @return Response
     */
	public function index(Customer $customer, Questionnaire $questionnaire, Section $section)
	{
		$data['questiongroups'] = $section->questiongroups->sortBy('order');
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
     * @param Requests\QuestiongroupRequest $request
     * @param Customer $customer
     * @param Questionnaire $questionnaire
     * @param Section $section
     * @return Response
     */
	public function store(Requests\QuestiongroupRequest $request, Customer $customer, Questionnaire $questionnaire, Section $section)
	{
		$questiongroup = new Questiongroup;
        $questiongroup->heading = $request->get('heading');
        $questiongroup->type = $request->get('type');
        $questiongroup->condition = $request->get('condition');
        $questiongroup->section_id = $section->id;
        $questiongroup->order = 200;
        $questiongroup->save();
        $questiongroup->order = $questiongroup->id;
        $questiongroup->save();

        if($questiongroup->type == 1 || $questiongroup->type == 4)
        {
            $question = new Question;
            $question->content = $questiongroup->heading;
            $question->questiongroup_id = $questiongroup->id;
            $question->save();
        }

        return redirect()->route('customer.questionnaire.section.questiongroup.index', [$customer,$questionnaire,$section]);
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
     * @param Questiongroup $questiongroup
     * @return Response
     * @internal param int $id
     */
	public function edit(Customer $customer, Questionnaire $questionnaire, Section $section, Questiongroup $questiongroup)
	{
		$data['customer'] = $customer;
        $data['questionnaire'] = $questionnaire;
        $data['section'] = $section;
        $data['questiongroup'] = $questiongroup;
        $data['questions'] = $questiongroup->questions;
        return view('questiongroup.edit')->with($data);
	}

    /**
     * Update the specified resource in storage.
     *
     * @param Requests\QuestiongroupRequest $request
     * @param Customer $customer
     * @param Questionnaire $questionnaire
     * @param Section $section
     * @param Questiongroup $questiongroup
     * @return Response
     * @internal param int $id
     */
	public function update(Requests\QuestiongroupRequest $request, Customer $customer, Questionnaire $questionnaire, Section $section, Questiongroup $questiongroup)
	{
        //dd($request->all());

        $questiongroup->condition = $request->get('condition');
        $questiongroup->heading = $request->get('heading');
        $questiongroup->save();
        foreach($questiongroup->questions as $question)
        {
            if($request->has('questions') && array_key_exists($question->id, $request->get('questions')))
                $question->content = $request->get('questions')[$question->id];
            else
                $question->delete();
        }
        if($request->has('options'))
        {
            foreach($request->get('options') as $option)
            {
                $question = new Question;
                $question->questiongroup_id = $questiongroup->id;
                $question->content = $option;
                $question->save();
            }
        }

        return redirect()->route('customer.questionnaire.section.questiongroup.index', [$customer, $questionnaire, $section]);

        return redirect()->route('customer.questionnaire.section.questiongroup.index', [$customer, $questionnaire, $section]);
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param Customer $customer
     * @param Questionnaire $questionnaire
     * @param Section $section
     * @param Questiongroup $questiongroup
     * @return Response
     * @internal param int $id
     */
	public function destroy(Customer $customer, Questionnaire $questionnaire, Section $section, Questiongroup $questiongroup)
	{
        foreach($questiongroup->questions as $question)
        {
            $question->delete();
        }
		$questiongroup->delete();
        return redirect()->route('customer.questionnaire.section.questiongroup.index', [$customer, $questionnaire, $section]);
	}

    /**
     * Reorder the Questiongroups based on the Sortable input.
     *
     * @param Customer $customer
     * @param Questionnaire $questionnaire
     * @param Section $section
     * @param Request $request
     * @return Response
     */
    public function order(Customer $customer, Questionnaire $questionnaire, Section $section, Request $request)
    {
        foreach($request->get('questiongroup') as $id=>$order)
        {
            $questiongroup = Questiongroup::find($id);
            $questiongroup->order = $order;
            $questiongroup->save();
        }

        return redirect()->route('customer.questionnaire.section.questiongroup.index', [$customer,$questionnaire,$section]);
        //dd($request->all());
    }

}
