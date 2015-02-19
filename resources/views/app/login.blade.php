<!DOCTYPE html>
<html class="uk-height-1-1 uk-notouch" style="background: url({{asset('img/pattern.png')}});">
<head>
    <title>Survey-X</title>
    <link rel="stylesheet" href="{{ elixir("css/app.css") }}" />
    <script src="{{ elixir("js/all.js") }}"></script>
</head>
<body class="uk-height-1-1">

<div class="uk-vertical-align uk-text-center uk-height-1-1">
    <div class="uk-vertical-align-middle" style="width: 250px;">

        <h1 class="uk-heading-large" style="color: white;">Login</h1>
        <form class="uk-panel uk-panel-box uk-form" method="POST" action="{{action('WelcomeController@authenticate')}}">
            <p class="uk-form-help-block uk-text-danger">{{$errors->first('login')}}</p>
            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            <div class="uk-form-row">
                <input class="uk-width-1-1 uk-form-large" type="text" name="username" placeholder="Benutzername">
                <p class="uk-form-help-block uk-text-danger">{{$errors->first('username')}}</p>
            </div>
            <div class="uk-form-row">
                <input class="uk-width-1-1 uk-form-large" type="password" name="password" placeholder="Passwort">
                <p class="uk-form-help-block uk-text-danger">{{$errors->first('password')}}</p>
            </div>
            <div class="uk-form-row">
                <button type="submit" class="uk-width-1-1 uk-button uk-button-primary uk-button-large">Anmelden</button>
            </div>
            <div class="uk-form-row uk-text-small">
                <label class="uk-float-left"><input type="checkbox" name="remember">Angemeldet bleiben</label>
                {{--<a class="uk-float-right uk-link uk-link-muted" href="#">Forgot Password?</a>--}}
            </div>
        </form>

    </div>
</div>



</body></html>