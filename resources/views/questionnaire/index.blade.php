@extends('partials.app')
@section('head-style')
    style="background: url({{asset('img/pattern.png')}});"
@stop
@section('header')
    @include('partials.nav')
@stop
@section('sidenav')
    <li><a href="{{route('customer.show', $customer)}}"><i class="fa fa-arrow-left"></i> Zurück zu Übersicht</a></li>
    <li><a href="{{route('customer.questionnaire.create', $customer)}}"><i class="fa fa-plus"></i> Fragebogen Hinzufügen</a></li>
    <li class="uk-nav-divider"></li>
    <li class="uk-parent">
        <a href="#"><i class="fa fa-info-circle"></i> Hilfe zu diesem Fenster</a>
        <ul class="uk-nav-sub">
            <li><p>Hier werden alle Fragebögen aufgelistet die im Moment im Account ihrer Firma gespeichert sind. um die Sektionenn eines Fragebogens einzusehen klicken Sie diesen an. <code>Bearbeiten</code> ermöglicht es ihnen den Name des Fragebogens zu verändern und <code>Löschen</code> entfernt ihn und alle Fragen unwiederruflich.</p></li>
        </ul>
    </li>
@stop
@section('content')
    <div class="uk-container uk-container-center">
        <div class="uk-panel uk-panel-box">
            <div class="uk-grid">
                <div class="width-1-2">
                    <h1>Alle Fragebögen</h1>
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
                                <td><a href="{{route('customer.questionnaire.section.index', [$customer, $questionnaire])}}">{{$questionnaire->title}}</a></td>
                                <td>{{$questionnaire->intern}}</td>
                                <td>
                                    <a class="uk-button uk-button-success" href="{{route('customer.questionnaire.duplicate',[$customer, $questionnaire])}}"><i class="fa fa-files-o"></i> Duplizieren</a>
                                    <a class="uk-button uk-button-primary" href="{{route('customer.questionnaire.edit',[$customer, $questionnaire])}}"><i class="fa fa-pencil"></i> Bearbeiten</a>
                                    <a href="{{route('customer.questionnaire.destroy', [$customer,$questionnaire]).'?_token='.csrf_token()}}" class="rest uk-button uk-button-danger" data-method="DELETE">Löschen <i class="fa fa-trash-o"></i></a>
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