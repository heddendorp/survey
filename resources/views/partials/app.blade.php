<!DOCTYPE html>
<html @yield('head-style')>
<head>
    @section('title')<title>Survey-X</title>@show
    <link rel="stylesheet" href="{{ elixir("css/app.css") }}" />
    <script src="{{ elixir("js/all.js") }}"></script>
    @yield('head')
</head>
<body>
@yield('header')
<div class="uk-grid">
    <div class="uk-width-1-4 uk-conatiner-center">
            <div class="uk-panel uk-panel-box uk-margin-large-left">
                <ul class="uk-nav uk-nav-side" data-uk-nav>
                    @yield('sidenav')
                </ul>
            </div>
    </div>
    <div class="uk-width-3-4">@yield('content')</div>
</div>

@yield('footer')
</body>
