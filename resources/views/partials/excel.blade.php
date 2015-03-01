<!DOCTYPE html>
<html @yield('head-style')>
<head>
    @section('title')<title>Survey-X</title>@show
    <link rel="stylesheet" href="{{ elixir("css/all.css") }}" />
    <script src="{{ elixir("js/all.js") }}"></script>
    @yield('head')
</head>
<body>
@yield('header')
<div class="uk-grid">
    <div class="uk-width-1-1">
        @yield('content')
    </div>
</div>

@yield('footer')
</body>
