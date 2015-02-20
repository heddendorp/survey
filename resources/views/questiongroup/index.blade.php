@extends('partials.app')
@section('head-style')
    style="background: url({{asset('img/pattern.png')}});"
@stop
@section('header')
    @include('partials.nav')
@stop
@section('sidenav')
    <li><a href="{{route('customer.questionnaire.index', $customer)}}">Alle Fragebögen</a></li>
    <li><a href="{{route('customer.questionnaire.section.index', [$customer, $questionnaire])}}">Alle Sektionen</a></li>
    <li><a href="{{route('customer.questionnaire.section.questiongroup.create', [$customer, $questionnaire, $section])}}">Frage Hinzufügen</a></li>
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
                    <ul data-uk-sortable>
                        @foreach($questiongroups as $questiongroup)
                            <li>
                                <div class="uk-panel uk-panel-box">
                                    <div class="uk-badge uk-badge-notification uk-panel-badge">0</div>
                                    <input type="hidden" name="questiongroup[{{$questiongroup->id}}]" value="0" />
                                    <strong>{{$questiongroup->heading}}</strong>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@stop