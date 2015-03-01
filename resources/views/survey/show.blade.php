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
    <li><a href="{{route('customer.survey.create', $customer)}}">Neue Umfrage beginnen</a></li>
    <li class="uk-parent">
        <a href="#">Hilfe zu diesem Fenster</a>
        <ul class="uk-nav-sub">
            <li><p></p></li>
        </ul>
    </li>
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
                    <a class="uk-button @if($survey->welcomed) uk-button-danger @else uk-button-primary @endif uk-width-1-1" href="{{route('customer.survey.sendWelcome',[$customer, $survey])}}">Mails senden @if($survey->welcomed) <strong>Achtung! Die Mails wurden bereits versandt.</strong> @endif </a>
                </div>
            </div>
                <hr class="uk-grid-divider"/>
            <div class="uk-grid">
                <div class="uk-width-1-1">
                    <h2>Auswertungen</h2>
                    <div class="uk-grid">
                        @foreach($results as $id=>$group)
                            <div class="uk-width-1-2">
                                <h3>{{$survey->facilities[$id]['name']}}</h3>
                                <div class="uk-grid">
                                    <div class="uk-width-1-1">
                                        @foreach($group as $result)
                                            <div class="ui card">
                                                <div class="content">
                                                    <div class="header">{{$survey->groups[$result->group]['name']}}</div>
                                                    <div class="meta">
                                                        @if($result->data != "")
                                                            <span>{{$result->pretty_date()}} zuletst aktualisiert</span>
                                                        @else
                                                            <span>Noch nicht analysiert</span>
                                                        @endif
                                                    </div>
                                                    <div class="description">
                                                        @if($result->data != "")
                                                            <a class="uk-button uk-button-primary" href="{{route('customer.survey.result', [$customer, $survey, $result])}}">Ansehen</a>
                                                        @endif
                                                            <a class="uk-button uk-button-success" href="{{route('customer.survey.analyze', [$customer, $survey, $result])}}">Erstellen</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
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