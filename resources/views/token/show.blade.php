@extends('partials.questionnaire')
@section('content')
    <h2 class="uk-margin-large-bottom">{{$questions['title']}}</h2>
    <form class="uk-form" method="POST" action="{{route('survey.token.answer',[$survey, $token])}}">
        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
        <div class="grid">
            @foreach($questions['questiongroups'] as $questiongroup)
                <div class="uk-width-1-1">
                    <fieldset class="uk-margin-large-bottom">
                        <legend>{{$questiongroup['heading']}}</legend>
                        @if($questiongroup['type'] == 2)
                            <div class="uk-flex">
                                <input type="hidden" name="answer[{{$questiongroup['id']}}][type]" value="{{$questiongroup['type']}}"/>
                                @foreach($questiongroup['questions'] as $question)
                                    <label class="uk-margin-right">
                                        <input type="radio" name="answer[{{$questiongroup['id']}}][answer]" value="{{$question['id']}}"/>
                                        {{$question['content']}}
                                    </label>
                                @endforeach
                            </div>
                        @elseif($questiongroup['type'] == 1)
                            <textarea name="answer[{{$questiongroup['id']}}][answer]" style="width: 100%;" rows="7"></textarea>
                            <input type="hidden" name="answer[{{$questiongroup['id']}}][type]" value="{{$questiongroup['type']}}"/>
                        @elseif($questiongroup['type'] == 3)
                            <div class="uk-grid">
                                <div class="uk-width-1-1">
                                    <div class="uk-grid">
                                        <div class="uk-width-1-3"></div>
                                        <div class="uk-width-2-3">
                                            <div class="uk-grid">
                                                <div class="uk-width-1-6">
                                                    sehr gut
                                                </div>
                                                <div class="uk-width-1-6">
                                                    gut
                                                </div>
                                                <div class="uk-width-1-6">
                                                    befriedigend
                                                </div>
                                                <div class="uk-width-1-6">
                                                    ausreichend
                                                </div>
                                                <div class="uk-width-1-6">
                                                    ungenügend
                                                </div>
                                                <div class="uk-width-1-6">
                                                    keine Bewertung
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @foreach($questiongroup['questions'] as $question)
                                    <input type="hidden" name="answer[{{$question['id']}}][type]" value="{{$questiongroup['type']}}"/>
                                    <div class="uk-width-1-1">
                                        <div class="uk-grid">
                                            <div class="uk-width-1-3">
                                                {{$question['content']}}
                                            </div>
                                            <div class="uk-width-2-3">
                                                <div class="uk-grid">
                                                    <div class="uk-width-1-6">
                                                        <input type="radio" name="answer[{{$question['id']}}][answer]" value="1"/>
                                                    </div>
                                                    <div class="uk-width-1-6">
                                                        <input type="radio" name="answer[{{$question['id']}}][answer]" value="2"/>
                                                    </div>
                                                    <div class="uk-width-1-6">
                                                        <input type="radio" name="answer[{{$question['id']}}][answer]" value="3"/>
                                                    </div>
                                                    <div class="uk-width-1-6">
                                                        <input type="radio" name="answer[{{$question['id']}}][answer]" value="4"/>
                                                    </div>
                                                    <div class="uk-width-1-6">
                                                        <input type="radio" name="answer[{{$question['id']}}][answer]" value="5"/>
                                                    </div>
                                                    <div class="uk-width-1-6">
                                                        <input checked type="radio" name="answer[{{$question['id']}}][answer]" value="0"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </fieldset>
                </div>
            @endforeach
            <div class="uk-width-1-1">
                <button class="uk-button uk-button-primary uk-button-large uk-align-right">Speichern & Fortfahren</button>
            </div>
        </div>
    </form>
@stop
