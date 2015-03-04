@extends('partials.app')
@section('head-style')
    style="background: url({{asset('img/pattern.png')}});"
@stop
@section('header')
    @include('partials.nav')
@stop
@section('sidenav')
    <li><a href="{{route('customer.show', $customer)}}">Zurück zu Übersicht</a></li>
    <li><a href="{{route('customer.user.index', $customer)}}">Alle Benutzer</a></li>
    <li class="uk-parent">
        <a href="#">Hilfe zu diesem Fenster</a>
        <ul class="uk-nav-sub">
            <li><p></p></li>
        </ul>
    </li>
@stop
@section('content')
    <div class="uk-container uk-container-center">
        <form class="uk-panel uk-panel-box uk-form" method="POST" action="{{route('customer.user.update', [$customer, $user])}}">
            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            <input type="hidden" name="_method" value="PATCH"/>
            <fieldset>
                <legend>Benutzer bearbeiten</legend>
                <div class="uk-grid">
                    <div class="uk-width-1-2">
                        <input class="uk-width-1-1 uk-form-large" type="text" name="username" placeholder="Name" value="{{$user->username}}">
                        <p class="uk-form-help-block uk-text-danger">{{$errors->first('username')}}</p>
                    </div>
                    <div class="uk-width-1-2">
                        <input class="uk-width-1-1 uk-form-large" type="email" name="email" placeholder="Email-Adresse" value="{{$user->email}}">
                        <p class="uk-form-help-block uk-text-danger">{{$errors->first('email')}}</p>
                    </div>
                    <div class="uk-width-1-2">
                        <input class="uk-width-1-1 uk-form-large" type="password" name="password" placeholder="Name" value="{{$user->password}}">
                        <p class="uk-form-help-block uk-text-danger">{{$errors->first('pasword')}}</p>

                    </div>
                    <div class="uk-width-1-2">
                        <input class="uk-width-1-1 uk-form-large" type="password" name="password_confirmation" placeholder="Name" value="{{$user->password}}">
                        <p class="uk-form-help-block uk-text-danger">{{$errors->first('pasword')}}</p>
                    </div>
                    <div class="uk-width-1-1">
                        <p class="uk-form-help-block">
                            Wenn Sie das Passwort des Benutzers neu setzten möchten, verändern sie es, ansonsten bleibt es wie zuvor.
                        </p>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend>Berechtigungen</legend>
                <div class="uk-grid">
                    @if($user->role == 'admin')
                        <span class="uk-text-primary">Der administrative Benutzer hat <strong>immer alle</strong> Brechtigungen.</span>
                    @else
                        <div class="uk-width-1-3">
                            <div class="uk-grid">
                                <div class="uk-width-1-1">
                                    <span><strong>Fargebögen, Sektionen und Fragen</strong></span>
                                </div>
                                <div class="uk-width-1-1 uk-margin-left">
                                    <input @if($user->role['questionnaire.view']) checked @endif name="questionnaire.view" type="checkbox"/>&nbsp;Ansehen
                                </div>
                                <div class="uk-width-1-1 uk-margin-left">
                                    <input @if($user->role['questionnaire.create']) checked @endif name="questionnaire.create" type="checkbox"/>&nbsp;Erstellen
                                </div>
                                <div class="uk-width-1-1 uk-margin-left">
                                    <input @if($user->role['questionnaire.edit']) checked @endif name="questionnaire.edit" type="checkbox"/>&nbsp;Bearbeiten
                                </div>
                                <div class="uk-width-1-1 uk-margin-left">
                                    <input @if($user->role['questionnaire.delete']) checked @endif name="questionnaire.delete" type="checkbox"/>&nbsp;Löschen
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-1-3">
                            <div class="uk-grid">
                                <div class="uk-width-1-1">
                                    <span><strong>Standorte, Gruppen und Kinder</strong></span>
                                </div>
                                <div class="uk-width-1-1 uk-margin-left">
                                    <input @if($user->role['participant.view']) checked @endif name="participant.view" type="checkbox"/>&nbsp;Ansehen
                                </div>
                                <div class="uk-width-1-1 uk-margin-left">
                                    <input @if($user->role['participant.create']) checked @endif name="participant.create" type="checkbox"/>&nbsp;Erstellen
                                </div>
                                <div class="uk-width-1-1 uk-margin-left">
                                    <input @if($user->role['participant.edit']) checked @endif name="participant.edit" type="checkbox"/>&nbsp;Bearbeiten
                                </div>
                                <div class="uk-width-1-1 uk-margin-left">
                                    <input @if($user->role['participant.delete']) checked @endif name="participant.delete" type="checkbox"/>&nbsp;Löschen
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-1-3">
                            <div class="uk-grid">
                                <div class="uk-width-1-1">
                                    <span><strong>Umfragen</strong></span>
                                </div>
                                <div class="uk-width-1-1 uk-margin-left">
                                    <input @if($user->role['survey.view']) checked @endif name="survey.view" type="checkbox"/>&nbsp;Ansehen
                                </div>
                                <div class="uk-width-1-1 uk-margin-left">
                                    <input @if($user->role['survey.create']) checked @endif name="survey.create" type="checkbox"/>&nbsp;Erstellen
                                </div>
                                <div class="uk-width-1-1 uk-margin-left">
                                    <input @if($user->role['survey.edit']) checked @endif name="survey.edit" type="checkbox"/>&nbsp;Bearbeiten
                                </div>
                                <div class="uk-width-1-1 uk-margin-left">
                                    <input @if($user->role['survey.delete']) checked @endif name="survey.delete" type="checkbox"/>&nbsp;Löschen
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-1-1 uk-margin-top">
                            <div class="uk-grid">
                                <div class="uk-width-1-1">
                                    <span><strong>Ergebnisse einsehen</strong><br/><small>Ein Benutzer muss Umfragen ansehen dürfen, um die Ergebnisse zu sehen.</small></span>
                                </div>
                                @foreach($customer->surveys as $survey)
                                    <div class="uk-width-1-1">
                                        <span>{{$survey->name}}</span>
                                    </div>
                                    <div class="uk-grid">
                                        @foreach($survey->results->groupBy('facility') as $key=>$result)
                                            <div class="uk-width-1-1 uk-margin-left">
                                                {{$survey->facilities[$key]['name']}}
                                                <div class="uk-grid">
                                                    @foreach($result as $group)
                                                        <div class="uk-width-1-1 uk-margin-left">
                                                            <input @if(isset($user->role['results'][$group->id])) checked @endif name="results[{{$group->id}}]" type="checkbox"/>&nbsp;{{$group->group_name}}
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </fieldset>
            <div class="uk-form-row uk-margin-top">
                <button type="submit" class="uk-width-1-1 uk-button uk-button-primary uk-button-large">Speichern</button>
            </div>
        </form>
@stop