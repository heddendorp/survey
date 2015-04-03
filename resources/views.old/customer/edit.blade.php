@extends('partials.app')
@section('head-style')
    style="background: url({{asset('img/pattern.png')}});"
@stop
@section('header')
    @include('partials.nav')
@stop
@section('sidenav')
    <li><a href="{{route('customer.show', $customer)}}"><i class="fa fa-arrow-left"></i> Zurück zu Übersicht</a></li>
    <li class="uk-nav-divider"></li>
    <li class="uk-parent">
        <a href="#"><i class="fa fa-info-circle"></i> Hilfe zu diesem Fenster</a>
        <ul class="uk-nav-sub">
            <li><p>In diesem Fanster können Sie die Daten über ihre Firma verändern. Diese sind für Teilnhemer des Frageboghens einsehbar.</p></li>
        </ul>
    </li>
@stop
@section('content')
    <div class="uk-container uk-container-center">
        <form class="uk-panel uk-panel-box uk-form" method="POST" action="{{route('customer.update', [$customer])}}">
            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            <input type="hidden" name="_method" value="PATCH"/>
            <fieldset>
                <legend>Firmeninfo bearbeiten</legend>
                <div class="uk-grid">
                    <div class="uk-width-1-2">
                        <input class="uk-width-1-1 uk-form-large" type="text" name="name" placeholder="Name" value="{{$customer->name}}">
                        <p class="uk-form-help-block uk-text-danger">{{$errors->first('name')}}</p>
                    </div>
                    <div class="uk-width-1-2">
                        <input class="uk-width-1-1 uk-form-large" type="text" name="info_email" placeholder="Info-Adresse" value="{{$customer->info_email}}">
                        <p class="uk-form-help-block uk-text-danger">{{$errors->first('info_email')}}</p>
                        <p class="uk-form-help-block">Email-Adresse die von den Teilnehmern für Rückfragen genutzt werden kann.</p>
                    </div>
                    <div class="uk-width-1-2">
                        <input class="uk-width-1-1 uk-form-large" type="text" name="logo" placeholder="Logo-URL" value="{{$customer->logo}}">
                        <p class="uk-form-help-block uk-text-danger">{{$errors->first('logo')}}</p>
                    </div>
                    <div class="uk-width-1-2">
                        <span>Logo Vorschau:</span>
                        <img src="{{$customer->logo}}"/>
                    </div>
                </div>
            </fieldset>
            <div class="uk-form-row uk-margin-top">
                <button type="submit" class="uk-width-1-1 uk-button uk-button-primary uk-button-large">Speichern</button>
            </div>
        </form>
@stop