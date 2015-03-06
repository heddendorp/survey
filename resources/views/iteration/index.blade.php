@extends('partials.app')
@section('head-style')
    style="background: url({{asset('img/pattern.png')}});"
@stop
@section('header')
    @include('partials.nav')
@stop
@section('sidenav')
    <li><a href="{{route('customer.show', $customer)}}"><i class="fa fa-arrow-left"></i> Zurück zu Übersicht</a></li>
    <li><a href="{{route('customer.iteration.create', $customer)}}"><i class="fa fa-plus"></i> Iteration Hinzufügen</a></li>
    <li class="uk-nav-divider"></li>
    <li class="uk-parent">
        <a href="#"><i class="fa fa-info-circle"></i>Hilfe zu diesem Fenster</a>
        <ul class="uk-nav-sub">
            <li><p>Iterationen werden dazu genutzt mehrere Sets von Teilnehmern zu unterscheiden, z.B. wenn sich jährlich die Gruppenbelegungen ändern. Hier werden alle aktuell gespeicherten Iterationen aufgelistet.</p></li>
        </ul>
    </li>
@stop
@section('content')
    <div class="uk-container uk-container-center">
        <div class="uk-panel uk-panel-box">
            <div class="uk-grid">
                <div class="width-1-2">
                    <h1>Alle Iterationen</h1>
                </div>
            </div>
            <hr class="uk-grid-divider"/>
            <div class="uk-grid">
                <div class="uk-width-1-1">
                    <table class="uk-table">
                        <thead>
                        <tr>
                            <th>
                                Beschreibung
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($iterations as $iteration)
                            <tr>
                                <td><a href="{{route('customer.iteration.facility.index', [$customer, $iteration])}}">{{$iteration->description}}</a></td>
                                <td>
                                    <a class="uk-button uk-button-primary" href="{{route('customer.iteration.edit',[$customer, $iteration])}}"><i class="fa fa-pencil"></i> Bearbeiten</a>
                                    <a href="{{route('customer.iteration.destroy', [$customer,$iteration]).'?_token='.csrf_token()}}" class="rest uk-button uk-button-danger" data-method="DELETE">Löschen <i class="fa fa-trash-o"></i></a>
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