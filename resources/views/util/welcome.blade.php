@extends('app.main')
@section('body')
    <div class="ui two column centered grid">
        <div class="column">
            <a class="ui green basic button" href="{{action('WelcomeController@login')}}">Login</a>
        </div>
    </div>
@stop