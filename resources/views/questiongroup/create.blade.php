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
    <li><a href="{{route('customer.questionnaire.section.questiongroup.index', [$customer, $questionnaire, $section])}}">Alle Fragen</a></li>
@stop
@section('content')
    <div class="uk-container uk-container-center">
        <form class="uk-panel uk-panel-box uk-form" method="POST" action="{{route('customer.questionnaire.section.questiongroup.store', [$customer, $questionnaire, $section])}}">
            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            <fieldset>
                <legend>Neue Frage</legend>
                <div class="uk-grid">
                    <div class="uk-width-1-2">
                        <input class="uk-width-1-1 uk-form-large" type="text" name="heading" placeholder="Frage">
                        <p class="uk-form-help-block uk-text-danger">{{$errors->first('heading')}}</p>
                    </div>
                    <div class="uk-width-1-2">
                        <select name="type" class="uk-width-1-1 uk-form-large">
                            <option value="1">Textfrage</option>
                            <option value="2">Auswahlfrage</option>
                            <option value="3">5er-Frage</option>
                            <option value="4">10er-Frage</option>
                        </select>
                        <p class="uk-form-help-block uk-text-danger">{{$errors->first('intern')}}</p>
                    </div>
                    <div class="uk-width-1-1">
                        <div class="uk-grid">
                            <div class="uk-width-1-2">
                                <span class="uk-form-help-inline uk-margin-top uk-float-right">Die Frage nur bei bestimmten Teilnehmern anzeigen</span>
                            </div>
                            <div class="uk-width-1-2">
                                <select name="condition" class="uk-form-large uk-width-1-1">
                                    <option value="1">Bei allen Teilnehmern</option>
                                    <option value="2">Nur bei Kindern in der Krippe</option>
                                    <option value="3">Nur bei Kindern im Kindergarten</option>
                                </select>
                                <p class="uk-form-help-block uk-text-danger">{{$errors->first('intern')}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
            <div class="uk-form-row uk-margin-top">
                <button type="submit" class="uk-width-1-1 uk-button uk-button-primary uk-button-large">Erstellen</button>
            </div>
        </form>
@stop