<!DOCTYPE html>
<html style="background-color: #727272;">
<head>
    <title>Survey-X</title>
    <link rel="stylesheet" href="{{ elixir("css/all.css") }}" />
    <script src="{{ elixir("js/all.js") }}"></script>
</head>
<body>
<div class="uk-cover-background" style="background-image: url({{asset('img/landing-mockup.jpg')}}); height: 370px;">
    <div class="uk-container uk-container-center">
        <div class="uk-grid">
            <div class="uk-width-1-4 uk-container-center" style="margin-top: 150px;">
                <div>
                    <h1 align="center">Survey-X</h1>
                    <h2 align="center">Registrierung</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<div style="background-color: #4CAF50;">
    <br/>
    <br/>
    <br/>
    <div class="uk-container uk-container-center">
        <form class="uk-panel uk-panel-box uk-form" method="POST" action="{{url('customer')}}">
            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            <fieldset>
                <legend>Administrativer Benutzer</legend>
                <div class="uk-grid">
                    <div class="uk-width-1-2">
                        <input class="uk-width-1-1 uk-form-large" type="text" name="username" placeholder="Benutzername">
                        <p class="uk-form-help-block uk-text-danger">{{$errors->first('username')}}</p>
                    </div>
                    <div class="uk-width-1-2">
                        <input class="uk-width-1-1 uk-form-large" type="email" name="email" placeholder="Email-Adresse">
                        <p class="uk-form-help-block uk-text-danger">{{$errors->first('email')}}</p>
                    </div>
                    <div class="uk-width-1-2">
                        <input class="uk-width-1-1 uk-form-large" type="password" name="password" placeholder="Passwort">
                        <p class="uk-form-help-block uk-text-danger">{{$errors->first('password')}}</p>
                    </div>
                    <div class="uk-width-1-2">
                        <input class="uk-width-1-1 uk-form-large" type="password" name="password_confirmation" placeholder="Passwort wiederholen">
                        <p class="uk-form-help-block uk-text-danger">{{$errors->first('password_confirmation')}}</p>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend>Firmeninfo</legend>
                <div class="uk-grid">
                    <div class="uk-width-1-2">
                        <input class="uk-width-1-1 uk-form-large" type="text" name="name" placeholder="Name">
                        <p class="uk-form-help-block uk-text-danger">{{$errors->first('name')}}</p>
                    </div>
                    <div class="uk-width-1-2">
                        <input class="uk-width-1-1 uk-form-large" type="email" name="info_email" placeholder="Info-Adresse">
                        <p class="uk-form-help-block">Email-Adresse die von den Teilnehmern für Rückfragen genutzt werden kann.</p>
                        <p class="uk-form-help-block uk-text-danger">{{$errors->first('info_email')}}</p>
                    </div>
                </div>
            </fieldset>
            <div class="uk-form-row uk-margin-top">
                <button type="submit" class="uk-width-1-1 uk-button uk-button-primary uk-button-large">Anmelden</button>
            </div>
        </form>
    </div>
    <br/>
    <br/>
    <br/>
</div>
</body>
</html>