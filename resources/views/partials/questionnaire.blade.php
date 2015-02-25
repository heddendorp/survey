<!DOCTYPE html>
<html style="background: url({{asset('img/giftly.png')}});">
<head>
    <title>{{$survey->name}}</title>
    <link rel="stylesheet" href="{{ elixir("css/app.css") }}" />
    <script src="{{ elixir("js/all.js") }}"></script>
    @yield('head')
</head>
<body>
@yield('header')
<div class="uk-container uk-container-center uk-margin-large-top">
    <div class="uk-grid">
        <div class="uk-width-1-4">
            <img class="uk-responsive-width" src="{{$customer->logo}}" alt=""/>
        </div>
        <div class="uk-width-2-4">
            <h1 class="uk-margin-top" align="center">{{$survey->name}}</h1>
        </div>
    </div>
</div>
<div class="uk-container uk-container-center">
    <div class="uk-panel uk-panel-box">
        @yield('content')
    </div>
</div>
@yield('footer')
</body>
