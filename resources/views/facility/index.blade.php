@extends('partials.app')
@section('head-style')
    style="background: url({{asset('img/pattern.png')}});"
@stop
@section('header')
    @include('partials.nav')
@stop
@section('sidenav')
    <li><a href="{{route('customer.show', $customer)}}"><i class="fa fa-arrow-left"></i> Zurück zu Übersicht</a></li>
    <li><a href="{{route('customer.iteration.index', $customer)}}"><i class="fa fa-database"></i> Alle Iterationen</a></li>
    <li><a href="{{route('customer.iteration.facility.create', [$customer, $iteration])}}"><i class="fa fa-plus"></i> Standort Hinzufügen</a></li>
    <li class="uk-nav-divider"></li>
    <li class="uk-parent">
        <a href="#"><i class="fa fa-info-circle"></i> Hilfe zu diesem Fenster</a>
        <ul class="uk-nav-sub">
            <li><p></p></li>
        </ul>
    </li>
@stop
@section('content')
    <div class="uk-container uk-container-center">
        <div class="uk-panel uk-panel-box">
            <div class="uk-grid">
                <div class="width-1-2">
                    <h1>Alle Standorte für <em>{{$iteration->description}}</em></h1>
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
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($facilities as $facility)
                            <tr>
                                <td><a href="{{route('customer.iteration.facility.group.index', [$customer, $iteration, $facility])}}">{{$facility->name}}</a></td>
                                <td>
                                    <a class="uk-button uk-button-primary" href="{{route('customer.iteration.facility.edit',[$customer, $iteration, $facility])}}"><i class="fa fa-pencil"></i> Bearbeiten</a>
                                    <a href="{{route('customer.iteration.facility.destroy', [$customer,$iteration, $facility]).'?_token='.csrf_token()}}" class="rest uk-button uk-button-danger" data-method="DELETE">Löschen <i class="fa fa-trash-o"></i></a>
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