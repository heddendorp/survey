<?php

namespace Survey\Http\Controllers;

use Survey\Commands\ColltectResults;
use Survey\Customer;
use Survey\Group;
use Survey\Http\Requests;
use Survey\Questionnaire;
use Survey\Result;
use Survey\Survey;
use Survey\Token;

class CustomerSurveyController extends Controller
{
    /**
     * Instantiate a new Controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('customerplus');
        $this->middleware('surveyPerms');
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
        $surveys = $customer->surveys;

        return view('survey.index')->withCustomer($customer)->withSurveys($surveys);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Customer $customer
     *
     * @return Response
     */
    public function create(Customer $customer)
    {
        return view('survey.create')->withCustomer($customer);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Customer               $customer
     * @param Requests\SurveyRequest $request
     *
     * @return Response
     */
    public function store(Customer $customer, Requests\SurveyRequest $request)
    {
        foreach ($request->get('group') as $id => $on) {
            $group = Group::find($id);
            $groups[$group->id] = $group->toArray();
            $facilities[$group->facility->id] = $group->facility->toArray();
        }
        $questionnaire = Questionnaire::find($request->get('questionnaire'));
        $i = 0;
        foreach ($questionnaire->sections as $section) {
            $questions[$i] = $section->toArray();
            $questiongroups = $section->questiongroups->sortBy('order');
            $qg = 0;
            foreach ($questiongroups as $questiongroup) {
                $questions[$i]['questiongroups'][$qg] = $questiongroup->toArray();
                $q = 0;
                foreach ($questiongroup->questions as $question) {
                    $questions[$i]['questiongroups'][$qg]['questions'][$q] = $question->toArray();
                    $q++;
                }
                $qg++;
            }
            $i++;
        }
        $survey = new Survey();
        $survey->groups = $groups;
        $survey->questions = $questions;
        $survey->facilities = $facilities;
        $survey->welcome_mail = $questionnaire->welcome_mail;
        $survey->remember_mail = $questionnaire->remember_mail;
        $survey->finish_mail = $questionnaire->finish_mail;
        $survey->end_date = \DateTime::createFromFormat('d.m.Y', $request->get('end_date'));
        $survey->questionnaire = $questionnaire->title;
        $survey->customer_id = $customer->id;
        $survey->name = $request->get('name');
        $survey->save();

        foreach ($request->get('group') as $id => $on) {
            $group = Group::find($id);
            $result = new Result();
            $result->survey_id = $survey->id;
            $result->facility = $group->facility->id;
            $result->group = $group->id;
            $result->facility_name = $group->facility->name;
            $result->group_name = $group->name;
            $result->save();
            foreach ($group->children as $child) {
                $token = new Token();
                $token->facility = $child->group->facility_id;
                $token->group = $child->group_id;
                $token->name = $child->name;
                $token->email = $child->email;
                $token->token = md5($child->name.$child->email.$child->id.time());
                $token->survey_id = $survey->id;
                $token->result_id = $result->id;
                $token->progress = 0;
                $token->save();
            }
        }

        return redirect()->route('customer.survey.index', $customer);
    }

    /**
     * Display the specified resource.
     *
     * @param Customer $customer
     * @param Survey   $survey
     *
     * @return Response
     *
     * @internal param int $id
     */
    public function show(Customer $customer, Survey $survey)
    {
        //dd($survey->questions);
        $results = $survey->results->groupBy('facility');
        //dd($results);
        return view('survey.show')->withCustomer($customer)->withSurvey($survey)->withResults($results);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Customer $customer
     * @param Survey   $survey
     *
     * @return Response
     *
     * @internal param int $id
     */
    public function edit(Customer $customer, Survey $survey)
    {
        return view('survey.edit')->withCustomer($customer)->withSurvey($survey);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Customer                     $customer
     * @param Survey                       $survey
     * @param Requests\SurveyUpdateRequest $request
     *
     * @return Response
     *
     * @internal param int $id
     */
    public function update(Customer $customer, Survey $survey, Requests\SurveyUpdateRequest $request)
    {
        $survey->welcome_mail = $request->get('welcome_mail');
        $survey->remember_mail = $request->get('remember_mail');
        $survey->finish_mail = $request->get('finish_mail');
        $survey->name = $request->get('name');
        $survey->end_date =  \DateTime::createFromFormat('d.m.Y', $request->get('end_date'));
        $survey->save();

        return redirect()->route('customer.survey.index', $customer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Customer $customer
     * @param Survey   $survey
     *
     * @return Response
     *
     * @throws \Exception
     *
     * @internal param int $id
     */
    public function destroy(Customer $customer, Survey $survey)
    {
        foreach ($survey->tokens as $token) {
            $token->delete();
        }
        foreach ($survey->results as $result) {
            $result->delete();
        }
        foreach ($survey->answers as $answer) {
            $answer->delete();
        }
        $survey->delete();

        return redirect()->route('customer.survey.index', $customer);
    }

    /**
     * Send begin Mails for selected Survey.
     *
     * @param Customer $customer
     * @param Survey   $survey
     *
     * @return Response
     *
     * @internal param int $id
     */
    public function sendMails(Customer $customer, Survey $survey, $type)
    {
        if($type == 1)
        {
            $tokens = $survey->tokens;
            $mail = $survey->welcome_mail;
        } elseif($type == 2) {
            $tokens = $survey->tokens()->whereFinished(false)->get();
            $mail = $survey->remember_mail;
        }
        if ($mail == '') {
            return redirect()->route('customer.survey.show', [$customer, $survey])->withErrors(['page' => 'Es wurde kein Text für die Email eingegeben!']);
        }
        foreach ($tokens as $token) {
            $text = $mail;
            $text = str_replace(':name', $token->name, $text);
            $key = $token->token;
            $link = route('survey.token.key', [$survey, $key]);
            $link = '<a href="'.$link.'">Fragebogen</a>';
            $text = str_replace(':link', $link, $text);
            $text = nl2br($text);
            $email = $token->email;
            $info = $customer->info_email;
            $name = $customer->name;
            $sname = $survey->name;
            \Mail::queue('emails.welcome', ['text' => $text], function ($message) use ($info, $name, $sname, $email) {
                $message->from($info, $name);
                $message->to($email)->subject($sname);
            });
        }
        $survey->welcomed = true;
        $survey->save();

        return redirect()->route('customer.survey.show', [$customer, $survey]);
    }

    /**
     * Triggers the result building process.
     *
     * @param Customer $customer
     * @param Survey   $survey
     * @param Result   $result
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function analyze(Customer $customer, Survey $survey, Result $result)
    {
        /*$result->answers = $result->answers->groupBy('question');
        $result->questions = $result->survey->questions;
        $this->dispatch(
            new ColltectResults($result)
        );
*/
        $all_answers = $result->answers->groupBy('question');
        if ($result->tokens()->where('finished', true)->count()<1) {
            return redirect()->route('customer.survey.show', [$customer, $survey])->withErrors(['page' => 'Es wurden noch keine Antworten abgegen.']);
        }
        $result->touch();
        $questions = $result->survey->questions;
        $i = 0;
        $type = $survey->groups[$result->group]['type'];
        foreach ($questions as $section) {
            $data[$i]['name'] = $section['title'];
            $q = 0;

            foreach ($section['questiongroups'] as $questiongroup) {
                if(($questiongroup['condition'] == 1) || ($questiongroup['condition'] == $type) || ($questiongroup['condition'] == 3 && $type ==1))
                {
                    $data[$i]['questiongroups'][$q]['name'] = $questiongroup['heading'];
                    $data[$i]['questiongroups'][$q]['type'] = $questiongroup['type'];
                    $data[$i]['questiongroups'][$q]['condition'] = $questiongroup['condition'];
                    switch ($questiongroup['type']) {
                        case 1:
                            $a = 0;
                            if (isset($all_answers[$questiongroup['id']])) {
                                $answers = $all_answers[$questiongroup['id']];

                                foreach ($answers as $answer) {
                                    $data[$i]['questiongroups'][$q]['answers'][$a] = $answer->text;
                                    $a++;
                                }
                            }
                            break;
                        case 2:
                            $a = 0;
                            $answers = $all_answers[$questiongroup['id']];
                            $part = 0;
                            $sol = array();
                            foreach ($answers as $answer) {
                                if($answer->type == 2)
                                {
                                    $part++;
                                    if (isset($sol[$answer->answer])) {
                                        $sol[$answer->answer]++;
                                    } else {
                                        $sol[$answer->answer] = 1;
                                    }
                                }
                            }
                            $res = array();
                            foreach ($questiongroup['questions'] as $question) {
                                if (!isset($sol[$question['id']])) {
                                    $sol[$question['id']] = 0;
                                }
                                $res[$a]['vote'] = $question['content'];
                                $res[$a]['absolut'] = $sol[$question['id']];
                                if($part == 0)
                                    $res[$a]['percent'] = 0;
                                else
                                    $res[$a]['percent'] = round(($sol[$question['id']]/$part)*100);
                                $a++;
                            }
                            $data[$i]['questiongroups'][$q]['answers'] = $res;
                            $data[$i]['questiongroups'][$q]['participants'] = $part;
                            break;

                        case 3:
                            //dd($questiongroup);
                            $a = 0;
                            foreach ($questiongroup['questions'] as $question) {
                                $answers = $all_answers[$question['id']];
                                //dd($answers);
                                $part = 0;
                                $allparts = 0;
                                $sol = array(0, 0, 0, 0, 0, 0);
                                foreach ($answers as $answer) {
                                    if ($answer->type == 3) {
                                        if($answer->answer != 0)
                                            $part++;
                                        $allparts++;
                                        $sol[$answer->answer]++;
                                    }
                                }
                                //dd($sol);
                                foreach ($sol as $key => $so) {
                                    $votes[$key]['absolut'] = $so;
                                    if($key == 0)
                                        $votes[$key]['percent'] = round(($so / $allparts) * 100);
                                    else
                                    {
                                        if($part == 0)
                                        {
                                            $votes[$key]['percent'] = 0;
                                        }
                                        else
                                        {
                                            $votes[$key]['percent'] = round(($so / $part) * 100);
                                        }
                                    }
                                    $votes[$key]['vote'] = $key;
                                }
                                //dd($votes);
                                $data[$i]['questiongroups'][$q]['answers'][$a]['participants'] = $part;
                                $data[$i]['questiongroups'][$q]['answers'][$a]['allparticipants'] = $allparts;
                                $data[$i]['questiongroups'][$q]['answers'][$a]['name'] = $question['content'];
                                $data[$i]['questiongroups'][$q]['answers'][$a]['votes'] = $votes;
                                $a++;
                            }
                            break;
                        case 4:
                            //dd($questiongroup);
                            $a = 0;
                            foreach ($questiongroup['questions'] as $question) {
                                $answers = $all_answers[$question['id']];
                                //dd($answers);
                                $part = 0;
                                $sol = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
                                foreach ($answers as $answer) {
                                    if ($answer->type == 4) {
                                        $part++;
                                        $sol[$answer->answer]++;
                                    }
                                }
                                //dd($sol);
                                foreach ($sol as $key => $so) {
                                    $votes[$key]['absolut'] = $so;
                                    $votes[$key]['percent'] = round(($so / $part) * 100);
                                    $votes[$key]['vote'] = $key;
                                }
                                //dd($votes);
                                $good = $votes[9]['percent'] + $votes[8]['percent'];
                                $bad = $votes[0]['percent'] + $votes[1]['percent'] + $votes[2]['percent'] + $votes[3]['percent'] +$votes[4]['percent'] + $votes[5]['percent'];
                                $data[$i]['questiongroups'][$q]['mps'] = $good-$bad;
                                $data[$i]['questiongroups'][$q]['answers'][$a]['participants'] = $part;
                                $data[$i]['questiongroups'][$q]['answers'][$a]['name'] = $question['content'];
                                $data[$i]['questiongroups'][$q]['answers'][$a]['votes'] = $votes;
                                $a++;
                            }
                            break;
                    }
                }
                $q++;
            }
            $i++;
        }
        $result->data = $data;
        //dd($data);
        $result->save();

        return redirect()->route('customer.survey.show', [$customer, $survey]);
    }
}
