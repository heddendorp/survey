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
    <li><a href="{{route('customer.iteration.facility.index', [$customer, $iteration])}}"><i class="fa fa-home"></i> Alle Standorte</a></li>
    <li><a href="{{route('customer.iteration.facility.group.index', [$customer, $iteration, $facility])}}"><i class="fa fa-users"></i> Alle Gruppen</a></li>
    <li><a href="{{route('customer.iteration.facility.group.child.index', [$customer, $iteration, $facility, $group])}}"><i class="fa fa-child"></i> Alle Kinder</a></li>
    <li class="uk-nav-divider"></li>
    <li class="uk-parent">
        <a href="#"><i class="fa fa-info-circle"></i> Hilfe zu diesem Fenster</a>
        <ul class="uk-nav-sub">
            <li><p></p></li>
        </ul>
    </li>

    <li class="uk-parent">
        <a href="#"><i class="fa fa-info-circle"></i> Hilfe zum Upload</a>
        <ul class="uk-nav-sub">
            <li><p>Bitte laden sie <a href="{{asset('files/demo.csv')}}">diese Tabelle</a> herunter und füllen sie mit den Name und Email-Adressen der Kinder. Specihern Sie die Tabelle ab und bestätigen Sie die eventuelle Rückfrage über den Verlust von Daten mit <code>Ja</code> Dann wählen Sie die Tabelle aus und importieren sie.</p></li>
        </ul>
    </li>
@stop
@section('content')
    <div class="uk-container uk-container-center">
        <form enctype="multipart/form-data" class="uk-panel uk-panel-box uk-form" method="POST" action="{{route('customer.iteration.facility.group.child.storemany', [$customer, $iteration, $facility, $group])}}">
            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            <fieldset>
                <legend>Kinder importieren</legend>
                <div class="uk-form-file uk-width-1-1">
                    <button class="uk-button uk-button-large uk-width-1-1 uk-button-primary">Tabelle auswählen</button>
                    <input type="file" name="sheet">
                </div>
                <p class="uk-form-help-block uk-text-danger">{{$errors->first('sheet')}}</p>
            </fieldset>
            <div class="uk-form-row uk-margin-top">
                <button type="submit" class="uk-width-1-1 uk-button uk-button-success uk-button-large">Importieren</button>
            </div>
        </form>
@stop
