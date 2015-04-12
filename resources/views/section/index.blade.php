@extends('partials.app')
@section('head-style')
    style="background: url({{asset('img/pattern.png')}});"
@stop
@section('header')
    @include('partials.nav')
@stop
@section('sidenav')
Hier sehen sie eine Auflistung aller Sektionen für <q>{{$questionnaire->title}}</q>.
Sie stellen sich dem Teilnehmer der Umfrage als Seiten dar die er der Reihe nach beatwortet.
Um die Fragen zu sehen die mit einer Sektion verknüpft sind, klicken Sie bitte auf den jeweiligen Namen.
Um den Namen der Sektion zu bearbeiten, klicken Sie bitte auf <code>bearbeiten</code>.
Ein klick auf <code>Löschen</code> löscht die Sektion und alle ihre Fragen unwierderruflich.
@stop
@section('content')
    <div class="uk-container uk-container-center">
        <div class="uk-panel uk-panel-box">
            <div class="uk-grid">
                <div class="width-1-2">
                    <h1>Sektionen für <em>{{$questionnaire->title}}</em></h1>
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
                        @foreach($sections as $section)
                            <tr>
                                <td><a href="{{route('customer.questionnaire.section.questiongroup.index', [$customer, $questionnaire, $section])}}">{{$section->title}}</a></td>
                                <td>{{$section->intern}}</td>
                                <td>
                                    <a class="uk-button uk-button-primary" href="{{route('customer.questionnaire.section.edit',[$customer, $questionnaire, $section])}}"><i class="fa fa-pencil"></i> Bearbeiten</a>
                                    <a href="{{route('customer.questionnaire.section.destroy', [$customer,$questionnaire, $section]).'?_token='.csrf_token()}}" class="rest uk-button uk-button-danger" data-method="DELETE">Löschen <i class="fa fa-trash-o"></i></a>
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