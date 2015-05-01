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
        <div class="uk-panel uk-panel-box">
            @if($survey->open)
                <div class="uk-panel-badge uk-badge uk-badge-success">Offen</div>
            @else
                <div class="uk-panel-badge uk-badge uk-badge-danger">Geschlossen</div>
            @endif
            <div class="uk-grid">
                <div class="width-1-2">
                    <h1>{{$survey->name}}</h1>
                </div>
            </div>
            <hr class="uk-grid-divider"/>
            <div class="uk-grid">
                <div class="uk-width-1-1">
                    <a class="uk-button @if($survey->welcomed) uk-button-danger @else uk-button-primary @endif uk-width-1-1" href="{{route('customer.survey.sendWelcome',[$customer, $survey, 1])}}">Start-Mails senden @if($survey->welcomed) <strong>Achtung! Die Mails wurden bereits versandt.</strong> @endif </a>
                    <a class="uk-button  uk-button-primary uk-width-1-1" href="{{route('customer.survey.sendWelcome',[$customer, $survey, 2])}}">Erinnerungs-Mails senden</a>
                </div>
            </div>
                <hr class="uk-grid-divider"/>
            <div class="uk-grid">
                <div class="uk-width-1-1">
                    <h2>Auswertungen</h2>
                    <div class="uk-grid">
                        @foreach($results as $id=>$kids)
                            <div class="uk-width-1-2">
                                <h3>{{$survey->facilities[$id]['name']}}&nbsp;<small><a target="_blank" href="{{route('customer.survey.result.facility', [$customer, $survey, $id, 1])}}">Excel-Ansicht</a>&nbsp;<a target="_blank" href="{{route('customer.survey.result.facility', [$customer, $survey, $id, 0])}}">Standardansicht</a></small></h3>
                                <div class="uk-grid">
                                    <div class="uk-width-1-1">
                                        <div class="ui cards">
                                            @foreach($kids as $result)
                                                <div class="ui card">
                                                    <div class="content">
                                                        <div class="header">{{$survey->groups[$result->group]['name']}}</div>
                                                        <div class="meta">
                                                            @if($result->data != "")
                                                                <span>{{$result->pretty_date()}} zuletzt aktualisiert</span>
                                                            @else
                                                                <span>Noch nicht analysiert</span>
                                                            @endif
                                                        </div>
                                                        <div class="description">
                                                            <div class="uk-grid">
                                                                @if($result->data != "")
                                                                    <div class="uk-button-dropdown uk-width-1-2" data-uk-dropdown="{mode:'click'}">
                                                                        <button class="uk-button uk-button-primary uk-width-1-1"><i class="fa fa-eye"></i> Ansehen</button>
                                                                        <div class="uk-dropdown">
                                                                            <ul class="uk-nav uk-nav-dropdown">
                                                                                <li><a href="{{route('customer.survey.result.standard', [$customer, $survey, $result])}}">Standardansicht</a></li>
                                                                                <li><a target="_blank" href="{{route('customer.survey.result.table', [$customer, $survey, $result])}}">Tabellenansicht</a></li>
                                                                                <li><a target="_blank" href="{{route('customer.survey.result.copy', [$customer, $survey, $result])}}">Ansicht zum kopieren</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <a class="uk-button uk-button-success uk-width-1-2" href="{{route('customer.survey.analyze', [$customer, $survey, $result])}}"><i class="fa fa-refresh"></i> Aktualisieren</a>
                                                                @else
                                                                    <div class="uk-width-1-2">
                                                                        <a class="uk-button uk-button-success uk-width-1-1" href="{{route('customer.survey.analyze', [$customer, $survey, $result])}}">Erstellen</a>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>


                </div>
            </div>
        </div>
    </div>
@stop