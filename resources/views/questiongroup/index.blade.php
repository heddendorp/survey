@extends('partials.app')
@section('head-style')
    style="background: url({{asset('img/pattern.png')}});"
@stop
@section('header')
    @include('partials.nav')
@stop
@section('helptext')
    Hilfetext fehlt
@stop
@section('content')
    <div class="uk-container uk-container-center">
        <div class="uk-panel uk-panel-box">
            <div class="uk-grid">
                <div class="width-1-2">
                    <h1>Fragen für <em>{{$section->title}}</em></h1>
                </div>
            </div>
            <hr class="uk-grid-divider"/>
            <div class="uk-grid">
                <div class="uk-width-1-1">
                    <form action="{{route('customer.questionnaire.section.questiongroup.order', [$customer, $questionnaire, $section])}}" method="POST">
                        <input type="hidden" name="_token" value="{{csrf_token()}}" />
                        <div class="uk-sortable" data-uk-sortable>
                            @foreach($questiongroups as $questiongroup)
                                <div>
                                    <div class="uk-panel uk-panel-box">
                                        <div class="uk-badge uk-badge-notification uk-panel-badge">0</div>
                                        <input type="hidden" id="sort" name="questiongroup[{{$questiongroup->id}}]" value="0" />
                                        <div class="uk-grid">
                                            <div class="uk-width-2-4">
                                                <strong>{{$questiongroup->heading}}</strong>
                                                @if($questiongroup->type == 2 || $questiongroup->type == 3)
                                                    @foreach($questiongroup->questions as $question)
                                                        <br/><span class="uk-margin-left">{{$question->content}}</span>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="uk-width-1-4">
                                                <span>{{$questiongroup->stringType()}}</span>
                                                <span>{{$questiongroup->stringCondition()}}</span>
                                            </div>
                                            <div class="uk-width-1-4">
                                                <a class="uk-button uk-button-primary" href="{{route('customer.questionnaire.section.questiongroup.edit', [$customer, $questionnaire, $section, $questiongroup])}}">Bearbeiten</a>
                                                <a href="{{route('customer.questionnaire.section.questiongroup.destroy', [$customer,$questionnaire, $section, $questiongroup]).'?_token='.csrf_token()}}" class="rest uk-button uk-button-danger" data-method="DELETE">Löschen</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button type="submit" class="uk-button uk-button-large uk-button-primary uk-width-1-1">Reihenfolge Speichern</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop