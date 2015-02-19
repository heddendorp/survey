@extends('partials.app')
@section('head-style')
    style="background: url({{asset('img/pattern.png')}});"
@stop
@section('header')
    @include('partials.nav')
@stop
@section('sidenav')
    <li><a href="{{route('customer.questionnaire.index', $customer)}}">Alle Fragebögen</a></li>
@stop
@section('content')
    <div class="uk-container uk-container-center">
        <form class="uk-panel uk-panel-box uk-form" method="POST" action="{{route('customer.questionnaire.store',$customer)}}">
            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            <fieldset>
                <legend>Neuer Fragebogen</legend>
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
                <button type="submit" class="uk-width-1-1 uk-button uk-button-primary uk-button-large">Erstellen</button>
            </div>
        </form>
@stop