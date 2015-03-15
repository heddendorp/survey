@extends('partials.app')
@section('head-style')
    style="background: url({{asset('img/pattern.png')}});"
@stop
@section('header')
    @include('partials.nav')
@stop
@section('sidenav')
    <li><a href="{{route('customer.edit', $customer)}}"><i class="uk-icon-wrench"></i><i class="fa fa-settings"></i> Enstellungen ändern</a></li>
@stop
@section("helptext")
    Hier erhalten Sie eine Übersicht über aktuell laufende Umfragen.
    @stop
@section('content')
    <div class="uk-container uk-container-center">
        <div class="uk-panel uk-panel-box">
            <div class="uk-grid">
                <div class="width-1-1">
                    <h1>Übersicht</h1>
                </div>
            </div>
        </div>
    </div>
@stop