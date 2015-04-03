@extends('app.main')
@section('body')
    @include('app.nav')
    <div class="ui grid">
        <div class="two wide column"></div>
        <div class="twelve wide column">
            @yield('outlet')
        </div>
    </div>
@stop
@section('footer')
    @yield('js')
@stop