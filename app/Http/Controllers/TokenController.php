<?php

namespace Survey\Http\Controllers;

use Survey\Answer;
use Illuminate\Http\Request;
use Survey\Survey;
use Survey\Token;

class TokenController extends Controller
{
    /**
     * @param Survey $survey
     * @param $key
     *
     * @return \Illuminate\View\View
     */
    public function key(Survey $survey, $key)
    {
        \Debugbar::disable();
        $customer = $survey->customer;
        $token = Token::where('token', $key)->first();
        //dd($survey->questions[$token->progress]);
        if ($token->finished) {
            return view('token.finished');
        }
        return view('token.closed');
        $token->type = $survey->groups[$token->group]['type'];

        return view('token.show')->withToken($token)->withSurvey($survey)->withCustomer($customer)->withQuestions($survey->questions[$token->progress]);
    }

    /**
     * @param Survey  $survey
     * @param Token   $token
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function answer(Survey $survey, Token $token, Request $request)
    {
        //dd($request->get('answer'));
        foreach ($request->get('answer') as $question => $answer) {
            $input = new Answer();
            $input->type = $answer['type'];
            $input->question = $question;
            $input->token()->associate($token);
            $input->survey()->associate($survey);
            $input->result()->associate($token->result);
            switch ($answer['type']) {
                case 1:
                    if ($answer['answer'] == '') {
                        break;
                    }
                    $input->answer = $question;
                    $input->text = $answer['answer'];
                    $input->save();
                    break;

                case 2:
                    if (array_key_exists('answer', $answer)) {
                        $input->answer = $answer['answer'];
                    } else {
                        $input->answer = 0;
                    }
                    $input->save();
                    break;
                case 3:
                    $input->answer = $answer['answer'];
                    $input->save();
                    break;
                case 4:
                    if (array_key_exists('answer', $answer)) {
                        $input->answer = $answer['answer'];
                        $input->save();
                    }
                    break;
            }
            unset($input);
        }
        $token->progress ++;
        if ($token->progress >= count($survey->questions)) {
            $token->finished = true;
            //return redirect()->route('customer.survey.analyze', [$survey->customer, $survey, $token->result]);
        }
        $token->save();

        return redirect()->route('survey.token.key', [$survey, $token->token]);
    }
}
