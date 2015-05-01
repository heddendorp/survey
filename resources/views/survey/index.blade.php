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
            <div class="uk-grid">
                <div class="width-1-2">
                    <h1>Alle Umfragen</h1>
                </div>
            </div>
            <hr class="uk-grid-divider"/>
            <div class="uk-grid">
                @foreach($surveys as $survey)
                    <div class="uk-width-1-2">
                        <div class="uk-panel uk-panel-box">
                            @if($survey->open)
                                <div class="uk-panel-badge uk-badge uk-badge-success">Offen</div>
                            @else
                                <div class="uk-panel-badge uk-badge uk-badge-danger">Geschlossen</div>
                            @endif
                            <h2 class="uk-panel-title"> <a href="{{route('customer.survey.show',[$customer, $survey])}}">{{$survey->name}}</a></h2>
                            <div class="uk-grid">
                                <div class="uk-width-2-3">
                                    <dl class="uk-description-list-horizontal">
                                        <dt>Schließt</dt>
                                        <dd>{{$survey->stringDate()}}</dd>
                                        <dt>Fragebogen</dt>
                                        <dd>{{$survey->questionnaire}}</dd>
                                        <dt>Teilnehmer</dt>
                                        <dd>{{$survey->tokens->count()}}</dd>
                                        <dt>Beteiligung</dt>
                                        <dd>{{$survey->tokens()->whereFinished(true)->count()}}</dd>
                                        <dd>{{round(($survey->tokens()->whereFinished(true)->count()/$survey->tokens->count())*100)}}%</dd>
                                    </dl>
                                </div>
                                <div class="uk-width-1-3">
                                    <div class="uk-grid">
                                        <div class="uk-width-1-1">
                                            <a class="uk-button uk-button-primary uk-width-1-1" href="{{route('customer.survey.edit',[$customer, $survey])}}"><i class="fa fa-pencil"></i> Bearbeiten</a>
                                        </div>
                                        <div class="uk-width-1-1">
                                            <a href="{{route('customer.survey.destroy', [$customer,$survey]).'?_token='.csrf_token()}}" class="rest uk-button uk-button-danger uk-width-1-1" data-method="DELETE">Löschen <i class="fa fa-trash-o"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@stop