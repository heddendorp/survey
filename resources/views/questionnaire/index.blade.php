@extends('partials.app')
@section('head-style')
    style="background: url({{asset('img/pattern.png')}});"
@stop
@section('header')
    @include('partials.nav')
@stop
@section('sidenav')
    <li><a href="{{route('customer.questionnaire.create', $customer)}}">Fragebogen Hinzufügen</a></li>
@stop
@section('content')
    <div class="uk-container uk-container-center">
        <div class="uk-panel uk-panel-box">
            <div class="uk-grid">
                <div class="width-1-2">
                    <h1>Fragebögen-Übersicht</h1>
                </div>
            </div>
            <hr class="uk-grid-divider"/>
            <div class="uk-grid">
                <div class="uk-width-1-1">
                    <table class="uk-table">
                        <thead>
                        <tr>
                            <th>
                                Name
                            </th>
                            <th>
                                Interner Name
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($questionnaires as $questionnaire)
                            <tr>
                                <td><a href="{{route('customer.questionnaire.show', [$customer, $questionnaire])}}">{{$questionnaire->title}}</a></td>
                                <td>{{$questionnaire->intern}}</td>
                                <td>
                                    <a href="{{route('customer.questionnaire.destroy', [$customer,$questionnaire]).'?_token='.csrf_token()}}" class="rest uk-button uk-button-danger" data-method="DELETE">Löschen</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop