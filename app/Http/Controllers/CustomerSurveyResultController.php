<?php

namespace Survey\Http\Controllers;

use Survey\Customer;
use Survey\Survey;
use Survey\Result;

class CustomerSurveyResultController extends Controller
{
    /**
     * Instantiate a new Controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('customerplus');
        $this->middleware('resultPerms');
    }

    /**
     * Show the result using the standard template.
     *
     * @param Customer $customer
     * @param Survey   $survey
     * @param Result   $result
     *
     * @return mixed
     */
    public function standard(Customer $customer, Survey $survey, Result $result)
    {
        //dd($result->data);

        return view('result.standard')->withSurvey($survey)->withCustomer($customer)->withResult($result);
    }

    /**
     * Show the result using the excel template.
     *
     * @param Customer $customer
     * @param Survey   $survey
     * @param Result   $result
     *
     * @return mixed
     */
    public function excel(Customer $customer, Survey $survey, Result $result)
    {
        return view('result.excel')->withSurvey($survey)->withCustomer($customer)->withResult($result);
    }

    /**
     * Show the result using the excel template.
     *
     * @param Customer $customer
     * @param Survey   $survey
     * @param Result   $result
     *
     * @return mixed
     */
    public function copy(Customer $customer, Survey $survey, Result $result)
    {
        //dd($result->data);
        return view('result.copy')->withSurvey($survey)->withCustomer($customer)->withResult($result);
    }

    /**
     * Show the result using the excel template.
     *
     * @param Customer $customer
     * @param Survey $survey
     * @param $id
     * @return mixed
     *
     */
    public function facility(Customer $customer, Survey $survey, $id, $view)
    {
        $results = Result::whereFacility($id)->whereSurveyId($survey->id)->get();
        $kiga = false;
        $kikr = false;
        foreach($results as $id=>$result)
        {
            $results[$id]->type = $survey->groups[$result->group]['type'];
            if($result->type == 1)
                $kiga = true;
            else
                $kikr = true;
            if($result->data == "")
                return redirect()->route('customer.survey.analyze', [$customer, $survey, $result])->withErrors(['page' => 'Eine Gruppe wurde noch nicht analysiert, es wurde versucht die nachzuholen.']);
        }
        $questions = $results[0]->survey->questions;
        $i = 0;

        //---------------------------------------
        foreach ($questions as $section) {
            $data[$i]['name'] = $section['title'];
            $q = 0;

            foreach ($section['questiongroups'] as $questiongroup) {
                if(($questiongroup['condition'] == 1) || ($questiongroup['condition'] == 2 && $kikr) || ($questiongroup['condition'] == 3 && $kiga))
                {
                    $data[$i]['questiongroups'][$q]['name'] = $questiongroup['heading'];
                    $data[$i]['questiongroups'][$q]['type'] = $questiongroup['type'];
                    $data[$i]['questiongroups'][$q]['condition'] = $questiongroup['condition'];
                    switch ($questiongroup['type']) {
                        case 1:
                            foreach($results as $result)
                            {
                                if(isset($result->data[$i]['questiongroups'][$q]['answers']))
                                {
                                    foreach($result->data[$i]['questiongroups'][$q]['answers'] as $answer)
                                    {
                                        $data[$i]['questiongroups'][$q]['answers'][] = $answer;
                                    }
                                }
                            }
                            break;
                        case 2:
                            $part = 0;
                            foreach ($results as $result)
                            {
                                $part += $result->data[$i]['questiongroups'][$q]['participants'];
                            }
                            $sol = array_fill(0, count($results[0]->data[$i]['questiongroups'][$q]['answers']), 0);
                            foreach ($results as $result)
                            {
                                $answers = $result->data[$i]['questiongroups'][$q]['answers'];
                                foreach ($answers as $id=>$answer)
                                {
                                    if(isset($sol[$id]))
                                        $sol[$id]+=$answer['absolut'];
                                    else
                                        $sol[$id]=$answer['absolut'];
                                }
                            }

                            foreach ($sol as $id=>$so)
                            {
                                $res[$id]['vote']= $results[0]->data[$i]['questiongroups'][$q]['answers'][$id]['vote'];
                                $res[$id]['absolut'] = $so;
                                $res[$id]['percent'] = round(($so/$part)*100);
                            }
                            $data[$i]['questiongroups'][$q]['answers'] = $res;
                            $data[$i]['questiongroups'][$q]['participants'] = $part;
                            break;

                        case 3:
                            //dd($questiongroup);
                            $a = 0;
                            foreach ($questiongroup['questions'] as $question) {
                                $sol=[0,0,0,0,0,0];
                                $part=0;
                                $allparts=0;
                                foreach ($results as $id=>$result) {
                                    if(isset($result->data[$i]['questiongroups'][$q]))
                                    {
                                        $part+= $result->data[$i]['questiongroups'][$q]['answers'][$a]['participants'];
                                        $allparts += $result->data[$i]['questiongroups'][$q]['answers'][$a]['allparticipants'];
                                        foreach($result->data[$i]['questiongroups'][$q]['answers'][$a]['votes'] as $id=>$vote)
                                        {
                                                $sol[$id] += $vote['absolut'];
                                        }
                                    }
                                }

                                foreach($sol as $id=>$so)
                                {
                                    $votes[$id]['absolut'] = $so;
                                    if($id == 0)
                                        $votes[$id]['percent'] = round(($so / $allparts) * 100);
                                    else
                                    {
                                        if($part == 0)
                                        {
                                            $votes[$id]['percent'] = 0;
                                        }
                                        else
                                        {
                                            $votes[$id]['percent'] = round(($so / $part) * 100);
                                        }
                                    }
                                    $votes[$id]['vote'] = $id;
                                }
                                $data[$i]['questiongroups'][$q]['answers'][$a]['participants'] = $part;
                                $data[$i]['questiongroups'][$q]['answers'][$a]['name'] = $question['content'];
                                $data[$i]['questiongroups'][$q]['answers'][$a]['votes'] = $votes;
                                $a++;
                            }
                            break;
                        case 4:
                            //dd($questiongroup);
                            $a = 0;
                            foreach ($questiongroup['questions'] as $question) {
                                $part = 0;
                                $sol = [0,0,0,0,0,0,0,0,0,0];
                                foreach($results as $result)
                                {
                                    $part += $result->data[$i]['questiongroups'][$q]['answers'][$a]['participants'];
                                    foreach($result->data[$i]['questiongroups'][$q]['answers'][$a]['votes'] as $id => $vote)
                                    {
                                        $sol[$id] += $vote['absolut'];
                                    }
                                }

                                foreach($sol as $id=>$so)
                                {
                                    $votes[$id]['absolut'] = $so;
                                    $votes[$id]['percent'] = round(($so / $part) * 100);
                                    $votes[$id]['vote'] = $id;
                                }
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
                    unset($sol);
                    unset($res);
                    unset($votes);
                    $q++;
                }
            }
            $i++;
        }

        //---------------------------------------
        $result=$results[0];
        $result->group_name = $customer->name;
        $result->data = $data;
        if($view)
            return view('result.copy')->withSurvey($survey)->withCustomer($customer)->withResult($result);
        return view('result.standard')->withSurvey($survey)->withCustomer($customer)->withResult($result);
    }
}
