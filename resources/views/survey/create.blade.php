@extends('partials.app')
@section('head-style')
    style="background: url({{asset('img/pattern.png')}});"
@stop
@section('header')
    @include('partials.nav')
@stop
@section('sidenav')
    <li><a href="{{route('customer.show', $customer)}}">Zurück zu Übersicht</a></li>
    <li><a href="{{route('customer.questionnaire.index', $customer)}}">Alle Umfragen</a></li>
    <li class="uk-parent">
        <a href="#">Hilfe zu diesem Fenster</a>
        <ul class="uk-nav-sub">
            <li><p></p></li>
        </ul>
    </li>
@stop
@section('content')
    <div class="uk-container uk-container-center">
        <form class="uk-panel uk-panel-box uk-form" method="POST" action="{{route('customer.survey.store', $customer)}}">
            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            <fieldset>
                <legend>Neue Umfrage</legend>
                <div class="uk-grid">
                    <div class="uk-width-1-1">
                        <p class="uk-form-help-block">Hier können Sie eine neue Umfrage beginnen. Bitte beachten Sie, das nach dem Erstellen der Ufrage keine Fragen und Teilnehmer mehr verändert werden können. Für die Umfrage wirdd eine Kopie des aktuellen Fragebogens und der ausgewählten Teilnhemer erstellt.</p>
                    </div>
                    <div class="uk-width-1-2">
                        <input class="uk-width-1-1 uk-form-large" type="text" name="title" placeholder="Titel">
                        <p class="uk-form-help-block uk-text-danger">{{$errors->first('title')}}</p>
                    </div>
                    <div class="uk-width-1-2">
                        <input class="uk-width-1-1 uk-form-large" type="text" name="intern" placeholder="Interner Titel">
                        <p class="uk-form-help-block uk-text-danger">{{$errors->first('intern')}}</p>
                    </div>
                </div>
            </fieldset>
            <div class="uk-form-row uk-margin-top">
                <button type="submit" class="uk-width-1-1 uk-button uk-button-primary uk-button-large">Erstellen</button>
            </div>
        </form>
@stop