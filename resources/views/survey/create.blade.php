@extends('partials.app')
@section('head-style')
    style="background: url({{asset('img/pattern.png')}});"
@stop
@section('header')
    @include('partials.nav')
@stop
@section('helptext')
    Kein Hilfetext
@stop
@section('content')
    <div class="uk-container uk-container-center">
        <form class="uk-panel uk-panel-box uk-form" method="POST" action="{{route('customer.survey.store', $customer)}}">
            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            <fieldset>
                <legend>Neue Umfrage</legend>
                <div class="uk-grid">
                    <div class="uk-width-1-1">
                        <p class="uk-form-help-block uk-margin-bottom">Hier können Sie eine neue Umfrage beginnen. Bitte beachten Sie, dass nach dem Erstellen der Umfrage keine Fragen und Teilnehmer mehr verändert werden können. Für die Umfrage wird eine Kopie des aktuellen Fragebogens und der ausgewählten Teilnhemer erstellt.</p>
                    </div>
                    <div class="uk-width-1-2">
                        <input class="uk-width-1-1 uk-form-large" type="text" name="name" placeholder="Bezeichnung der Umfrage">
                        <p class="uk-form-help-block uk-text-danger">{{$errors->first('name')}}</p>
                    </div>
                    <div class="uk-width-1-2">
                        <select class="uk-width-1-1 uk-form-large" name="questionnaire">
                            @foreach($customer->questionnaires as $questionnaire)
                                <option value="{{$questionnaire->id}}">{{$questionnaire->title}}/{{$questionnaire->intern}}</option>
                            @endforeach
                        </select>
                        <p class="uk-form-help-block">Bitte wählen Sie einen Fragebogen für diese Umfrage aus.</p>
                    </div>
                    <div class="uk-width-1-2">
                        <input class="uk-width-1-1 uk-form-large" type="" name="end_date" placeholder="Enddatum" data-uk-datepicker="{format:'DD.MM.YYYY', i18n:{months:['Jannuar','Februar','März','April','Mai','Juni','Juli','August','September','Oktober','November','Dezember'], weekdays:['So','Mo','Di','Mi','Do','Fr','Sa']}}">
                        <p class="uk-form-help-block uk-text-danger">{{$errors->first('end_date')}}</p>
                    </div>

                </div>
            </fieldset>
            <fieldset>
                <legend>Teilnehmer</legend>
                <div class="uk-grid">
                    <div class="uk-width-1-1">
                        <p class="uk-form-help-block uk-margin-bottom">Bitte wählen Sie nachfolgend die Gruppen aus die an der Umfrage teilnehmen sollen.</p>
                        <p class="uk-form-help-block uk-text-danger">{{$errors->first('group')}}</p>
                    </div>
                    @foreach($customer->iterations as $iteration)
                        <div class="uk-width-1-3">
                            <label>
                                {{$iteration->description}}
                            </label><br/>
                            <div class="uk-margin-left">
                                @foreach($iteration->facilities as $facility)
                                    <label>
                                        {{$facility->name}}
                                    </label><br/>
                                    <div class="uk-margin-left">
                                        @foreach($facility->groups as $group)
                                            <label>
                                                <input type="checkbox" name="group[{{$group->id}}]"/>
                                                {{$group->name}}/<small>{{$group->stringType()}}</small>
                                            </label><br/>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </fieldset>
            <div class="uk-form-row uk-margin-top">
                <button type="submit" class="uk-width-1-1 uk-button uk-button-success uk-button-large">Erstellen</button>
            </div>
        </form>
@stop