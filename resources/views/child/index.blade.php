@extends('partials.app')
@section('head-style')
    style="background: url({{asset('img/pattern.png')}});"
@stop
@section('header')
    @include('partials.nav')
@stop
@section('sidenav')
    <li><a href="{{route('customer.show', $customer)}}">Zurück zu Übersicht</a></li>
    <li><a href="{{route('customer.iteration.index', $customer)}}">Alle Iterationen</a></li>
    <li><a href="{{route('customer.iteration.facility.index', [$customer, $iteration])}}">Alle Standorte</a></li>
    <li><a href="{{route('customer.iteration.facility.group.index', [$customer, $iteration, $facility])}}">Alle Gruppen</a></li>
    <li><a href="{{route('customer.iteration.facility.group.child.create', [$customer, $iteration, $facility, $group])}}">Kind Hinzufügen</a></li>
    <li><a href="{{route('customer.iteration.facility.group.child.multi', [$customer, $iteration, $facility, $group])}}">Mehrere Kinder hinzufügen</a></li>
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
            <div class="uk-grid">
                <div class="width-1-2">
                    <h1>Alle Kinder in <em>{{$group->name}}</em></h1>
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
                                Email-Adresse
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($children as $child)
                            <tr>
                                <td>{{$child->name}}</td>
                                <td>{{$child->email}}</td>
                                <td>
                                    <a class="uk-button uk-button-primary" href="{{route('customer.iteration.facility.group.child.edit',[$customer, $iteration, $facility, $group, $child])}}">Bearbeiten</a>
                                    <a href="{{route('customer.iteration.facility.group.child.destroy', [$customer,$iteration, $facility, $group, $child]).'?_token='.csrf_token()}}" class="rest uk-button uk-button-danger" data-method="DELETE">Löschen</a>
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