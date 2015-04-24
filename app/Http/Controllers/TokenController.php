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
                    $answer['answer']=str_replace(' ', '', $answer['answer']);
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
                    } else {
                        $input->answer = 0;
                    }
                    $input->save();
                    break;
            }
            //dd($input);
            unset($input);
            /*if($answer['type'] == 1 && !$answer['answer'] == "" )
            {
                $result = new Answer;
                $result->type = $answer['type'];
                $result->question = $question;
                $result->answer = $question;
                $result->text = $answer['answer'];
                $result->token_id = $token->id;
                $result->survey_id = $survey->id;
                $result->result_id = $token->result_id;
                $result->save();
            }
            else
            {
                $result = new Answer;
                $result->type = $answer['type'];
                $result->question = $question;
                $result->token_id = $token->id;
                $result->survey_id = $survey->id;
                if (array_key_exists('answer', $answer))
                    $result->answer = $answer['answer'];
                else
                    $result->answer = 0;
                $result->result_id = $token->result_id;
                $result->save();
            }*/
        }
        $token->progress ++;
        if ($token->progress >= count($survey->questions)) {
            $token->finished = true;
        }
        $token->save();

        return redirect()->route('survey.token.key', [$survey, $token->token]);
    }
}
