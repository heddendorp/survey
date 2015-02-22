@extends('partials.app')
@section('head-style')
    style="background: url({{asset('img/pattern.png')}});"
@stop
@section('header')
    @include('partials.nav')
@stop
@section('sidenav')
    <li><a href="{{route('customer.show', $customer)}}">Zurück zu Übersicht</a></li>
    <li><a href="{{route('customer.survey.index', $customer)}}">Alle Umfragen</a></li>
    <li class="uk-parent">
        <a href="#">Hilfe zu diesem Fenster</a>
        <ul class="uk-nav-sub">
            <li><p></p></li>
        </ul>
    </li>
@stop
@section('content')
    <div class="uk-container uk-container-center">
        <form class="uk-panel uk-panel-box uk-form" method="POST" action="{{route('customer.survey.update', [$customer, $survey])}}">
            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            <input type="hidden" name="_method" value="PATCH"/>
            <fieldset>
                <legend>Umfrage bearbeiten</legend>
                <div class="uk-grid">
                    <div class="uk-width-1-2">
                        <input class="uk-width-1-1 uk-form-large" type="text" name="name" placeholder="Name" value="{{$survey->name}}">
                        <p class="uk-form-help-block uk-text-danger">{{$errors->first('name')}}</p>
                    </div>
                    <div class="uk-width-1-1">
                        <textarea name="welcome_mail" style="width: 100%" rows="10">{{$survey->welcome_mail}}</textarea>
                        <p class="uk-form-help-block">Bitte geben sie hier den Text der Mail an, die die Teilnehmer zu beginn der Umfrage erhalten. Verwenden sie <code>:name</code> als Platzhalter für den Namen des Kindes und <code>:link</code> als Platzhalter für den Link zum Fragebogen.</p>
                        <br/>
                    </div>
                    <div class="uk-width-1-1">
                        <textarea name="remember_mail" style="width: 100%" rows="10">{{$survey->remember_mail}}</textarea>
                        <p class="uk-form-help-block">Bitte geben sie hier den Text der Mail an, die die Teilnehmer erhalten um an die Umfrage zu erinnern. Verwenden sie <code>:name</code> als Platzhalter für den Namen des Kindes und <code>:link</code> als Platzhalter für den Link zum Fragebogen.</p>
                        <br/>
                    </div>
                    <div class="uk-width-1-1">
                        <textarea name="finish_mail" style="width: 100%" rows="10">{{$survey->finish_mail}}</textarea>
                        <p class="uk-form-help-block">Bitte geben sie hier den Text der Mail an, die die Teilnehmer erhalten sobald sie die Umfrage abschließen. Verwenden sie <code>:name</code> als Platzhalter für den Namen des Kindes.</p>
                        <br/>
                    </div>
                </div>
            </fieldset>
            <div class="uk-form-row uk-margin-top">
                <button type="submit" class="uk-width-1-1 uk-button uk-button-primary uk-button-large">Speichern</button>
            </div>
        </form>
@stop