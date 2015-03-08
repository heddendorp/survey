<?php namespace Survey\Http\Controllers;

use Survey\Answer;
use Survey\Http\Requests;
use Survey\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Survey\Survey;
use Survey\Token;

class TokenController extends Controller {

    /**
     * @param Survey $survey
     * @param $key
     * @return \Illuminate\View\View
     */
    public function key(Survey $survey, $key)
    {
        $customer = $survey->customer;
        $token = Token::where('token',$key)->first();
        if($token->progress >= count($survey->questions))
            return view('token.finished');
        return view('token.show')->withToken($token)->withSurvey($survey)->withCustomer($customer)->withQuestions($survey->questions[$token->progress]);
    }

    /**
     * @param Survey $survey
     * @param Token $token
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function answer(Survey $survey, Token $token, Request $request)
    {
        //dd($request->get('answer'));
        foreach($request->get('answer') as $question=>$answer)
        {
            if($answer['type'] == 1 && !$answer['answer'] == "" )
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
            elseif(!array_key_exists('answer', $answer) || !$answer['answer'] == "")
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
            }
        }
        $token->progress ++;
        $token->save();
        return redirect()->route('survey.token.key',[$survey, $token->token]);
    }

}
