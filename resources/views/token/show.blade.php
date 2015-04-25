@extends('partials.questionnaire')
@section('content')
    <h2 class="uk-margin-large-bottom">{{$questions['title']}}</h2>
    <form class="uk-form" method="POST" action="{{route('survey.token.answer',[$survey, $token])}}">
        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
        <div class="grid">
            @foreach($questions['questiongroups'] as $questiongroup)
                @if(($questiongroup['condition'] == 1) || ($questiongroup['condition'] == $token->type) || ($questiongroup['condition'] == 3 && $token->type ==1))
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
                            @elseif($questiongroup['type'] == 4)
                                <div class="uk-grid">
                                    <div class="uk-width-1-1">
                                        <div class="uk-grid">
                                            <div class="uk-width-1-3"></div>
                                            <div class="uk-width-2-3">
                                                <div class="uk-grid">
                                                    <div class="uk-width-1-10">10</div>
                                                    <div class="uk-width-1-10">9</div>
                                                    <div class="uk-width-1-10">8</div>
                                                    <div class="uk-width-1-10">7</div>
                                                    <div class="uk-width-1-10">6</div>
                                                    <div class="uk-width-1-10">5</div>
                                                    <div class="uk-width-1-10">4</div>
                                                    <div class="uk-width-1-10">3</div>
                                                    <div class="uk-width-1-10">2</div>
                                                    <div class="uk-width-1-10">1</div>
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
                                                        <div class="uk-width-1-10">
                                                            <input type="radio" name="answer[{{$question['id']}}][answer]" value="9"/>
                                                        </div>
                                                        <div class="uk-width-1-10">
                                                            <input type="radio" name="answer[{{$question['id']}}][answer]" value="8"/>
                                                        </div>
                                                        <div class="uk-width-1-10">
                                                            <input type="radio" name="answer[{{$question['id']}}][answer]" value="7"/>
                                                        </div>
                                                        <div class="uk-width-1-10">
                                                            <input type="radio" name="answer[{{$question['id']}}][answer]" value="6"/>
                                                        </div>
                                                        <div class="uk-width-1-10">
                                                            <input type="radio" name="answer[{{$question['id']}}][answer]" value="5"/>
                                                        </div>
                                                        <div class="uk-width-1-10">
                                                            <input type="radio" name="answer[{{$question['id']}}][answer]" value="4"/>
                                                        </div>
                                                        <div class="uk-width-1-10">
                                                            <input type="radio" name="answer[{{$question['id']}}][answer]" value="3"/>
                                                        </div>
                                                        <div class="uk-width-1-10">
                                                            <input type="radio" name="answer[{{$question['id']}}][answer]" value="2"/>
                                                        </div>
                                                        <div class="uk-width-1-10">
                                                            <input type="radio" name="answer[{{$question['id']}}][answer]" value="1"/>
                                                        </div>
                                                        <div class="uk-width-1-10">
                                                            <input type="radio" name="answer[{{$question['id']}}][answer]" value="0"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="uk-width-1-1">
                                        <div class="uk-grid">
                                            <div class="uk-width-1-3"></div>
                                            <div class="uk-width-2-3">
                                                <div class="uk-grid">
                                                    <div class="uk-width-1-6" style="padding-right: 4%; margin-left: -2%;">Ja, auf jeden Fall</div>
                                                    <div class="uk-width-1-6"></div>
                                                    <div class="uk-width-1-6"></div>
                                                    <div class="uk-width-1-6"></div>
                                                    <div class="uk-width-1-6"></div>
                                                    <div class="uk-width-1-6" style="margin-left: 5%;width: 13%;">Nein, auf keinen Fall</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </fieldset>
                    </div>
                @endif
            @endforeach
            <div class="uk-width-1-1">
                <button class="uk-button uk-button-primary uk-button-large uk-align-right">Speichern & Fortfahren</button>
            </div>
        </div>
    </form>
@stop
