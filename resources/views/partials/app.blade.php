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
@yield('content')
@yield('footer')
</body>
