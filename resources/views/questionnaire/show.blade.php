@extends('partials.app')
@section('head-style')
    style="background: url({{asset('img/pattern.png')}});"
@stop
@section('header')
    @include('partials.nav')
@stop
@section('sidenav')
    <li><a href="{{route('customer.questionnaire.index', $customer)}}">Alle Fragebögen</a></li>
    <li><a href="{{route('customer.questionnaire.edit', [$customer, $questionnaire])}}">Enstellungen ändern</a></li>
@stop
@section('content')
    <div class="uk-container uk-container-center">
        <div class="uk-panel uk-panel-box">
            <div class="uk-grid">
                <div class="width-1-1">
                    <h1>{{$questionnaire->title}} <small>/{{$questionnaire->intern}}</small></h1>
                </div>
            </div>
            <hr class="uk-grid-divider"/>
            <div class="uk-grid">
                <div class="uk-width-1-1">
                    <h3>Email zu beginn der Umfrage</h3>
                        {!! !$questionnaire->welcome_mail=="" ? nl2br($questionnaire->welcome_mail) : 'Bitte füegen sie einen Text in den Einstellungen ein.'!!}
                </div>
            </div>
            <hr class="uk-grid-divider"/>
            <div class="uk-grid">
                <div class="uk-width-1-1">
                    <h3>Email als Erinnerung an die Umfrage</h3>
                        {!! !$questionnaire->remember_mail=="" ? nl2br($questionnaire->remember_mail) : 'Bitte füegen sie einen Text in den Einstellungen ein.'!!}
                </div>
            </div>
            <hr class="uk-grid-divider"/>
            <div class="uk-grid">
                <div class="uk-width-1-1">
                    <h3>Email bei Abschluss der Umfrage</h3>
                        {!! !$questionnaire->finish_mail=="" ? nl2br($questionnaire->finish_mail) : 'Bitte füegen sie einen Text in den Einstellungen ein.'!!}
                </div>
            </div>
        </div>
    </div>
@stop