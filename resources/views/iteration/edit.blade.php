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
        <form class="uk-panel uk-panel-box uk-form" method="POST" action="{{route('customer.iteration.update', [$customer, $iteration])}}">
            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            <input type="hidden" name="_method" value="PATCH"/>
            <fieldset>
                <legend>Iteration bearbeiten</legend>
                <div class="uk-grid">
                    <div class="uk-width-1-1">
                        <input class="uk-width-1-1 uk-form-large" type="text" name="description" placeholder="Beschreibung" value="{{$iteration->description}}">
                        <p class="uk-form-help-block uk-text-danger">{{$errors->first('description')}}</p>
                        <p class="uk-form-help-block">Beschreiben Sie kurz welchen Zweck diese Ietration erfüllt. Z.B. <q>Teilnehmer und Gruppen 2015</q></p>

                    </div>
                </div>
            </fieldset>
            <div class="uk-form-row uk-margin-top">
                <button type="submit" class="uk-width-1-1 uk-button uk-button-primary uk-button-large">Speichern</button>
            </div>
        </form>
@stop