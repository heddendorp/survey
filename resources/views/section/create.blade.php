@extends('partials.app')
@section('head-style')
    style="background: url({{asset('img/pattern.png')}});"
@stop
@section('header')
    @include('partials.nav')
@stop
@section('sidenav')
    <li><a href="{{route('customer.show', $customer)}}"><i class="fa fa-arrow-left"></i> Zurück zu Übersicht</a></li>
    <li><a href="{{route('customer.questionnaire.index', $customer)}}"><i class="fa fa-database"></i> Alle Fragebögen</a></li>
    <li><a href="{{route('customer.questionnaire.section.index', [$customer, $questionnaire])}}"><i class="fa fa-database"></i> Alle Sektionen</a></li>
    <li class="uk-nav-divider"></li>
    <li class="uk-parent">
        <a href="#"><i class="fa fa-info-circle"></i>Hilfe zu diesem Fenster</a>
        <ul class="uk-nav-sub">
            <li><p>Hier können sie eine neue Sektion für <q>{{$questionnaire->title}}</q> erstellen. Diese wird dann mit dem Fragebogen verknüpft. Nur <code>Tiel</code> wird für die Teilnehmer der umfrage einsehbar sein. <code>Interner Titel</code> nur für die Nutzer dieses Systems.</p></li>
        </ul>
    </li>
@stop
@section('content')
    <div class="uk-container uk-container-center">
        <form class="uk-panel uk-panel-box uk-form" method="POST" action="{{route('customer.questionnaire.section.store', [$customer, $questionnaire])}}">
            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            <fieldset>
                <legend>Neue Sektion</legend>
                <div class="uk-grid">
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
                <button type="submit" class="uk-width-1-1 uk-button uk-button-success uk-button-large">Erstellen</button>
            </div>
        </form>
@stop