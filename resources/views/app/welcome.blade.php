<!DOCTYPE html>
<html>
<head>
    <title>Survey-X</title>
    <link rel="stylesheet" href="{{ elixir("css/app.css") }}" />
    <script src="{{ elixir("js/all.js") }}"></script>
</head>
<body>
<div class="uk-cover-background" style="background-image: url({{asset('img/landing-mockup.jpg')}}); height: 370px;">
    <div class="uk-container uk-container-center">
        <div class="uk-grid">
            <div class="uk-width-1-4 uk-container-center" style="margin-top: 150px;">
                <div>
                    <h1 align="center">Survey-X</h1>
                    <div class="uk-grid">
                        <div class="uk-width-1-2">
                            <a href="{{action('WelcomeController@login')}}" class="uk-button uk-button-large uk-button-success uk-width-1-1" style="background-color: #4CAF50;">Anmelden</a>
                        </div>
                        <div class="uk-width-1-2">
                            <a href="{{action('CustomerController@create')}}" class="uk-button uk-button-large uk-button-primary uk-width-1-1" style="background-color: #FF5722;">Registrieren</a>
                        </div>
                    </div>
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
        <div class="uk-grid">
            <div class="uk-width-1-3">
                <h2 style="color: white;" align="center">Einfach</h2>
            </div>
            <div class="uk-width-1-3">
                <h2 style="color: white;" align="center">Schnell</h2>
            </div>
            <div class="uk-width-1-3">
                <h2 style="color: white;" align="center">Für Kindergärten und -krippen</h2>
            </div>
        </div>
        <br/>
        <br/>
        <div class="uk-grid">
            <div class="uk-width-1-3">
                <p style="color: white;">
                    Das Survey-X System erlaubt es ihnen schnell und unkompliziert Zufriedenhetsumfragen zu erstellen. Es sind keine Kenntnisse in Programmiersprachen erforderlich.
                </p>
            </div>
            <div class="uk-width-1-3">
                <p style="color: white;">
                    Die Sammlung und der Antowrten ist online stark beschleunigt und die Auswertung der Fragebögen nimmt nur noch Sekunden in Anspruch. Wir haben des weiteren die Eingabe der Fragebögen und Erfassung der Teilnehmer so schnell wie möglich gestaltet.
                </p>
            </div>
            <div class="uk-width-1-3">
                <p style="color: white;">
                    Das gesamte System wurde im Hinblick auf Kindergärten und -krippen entwickelt und bietet so eine perfekte Umgebung für ihre Umfragen.
                </p>
            </div>
        </div>
        <br/>
        <br/>
    </div>
</div>
<div style="background-color: #727272;">
    <br/>
    <br/>
    <br/>
    <div class="uk-container uk-container-center">
        <div class="uk-grid">
            <div class="uk-width-1-3">
                <h2 style="color: white;" align="center">Ständige Entwicklung <img src="https://travis-ci.org/Isigiel/survey.svg" alt=""/></h2>
            </div>
            <div class="uk-width-1-3">
                <h2 style="color: white;" align="center">Sicherheit</h2>
            </div>
            <div class="uk-width-1-3">
                <h2 style="color: white;" align="center">Unterstützung</h2>
            </div>
        </div>
        <br/>
        <br/>
        <div class="uk-grid">
            <div class="uk-width-1-3">
                <p style="color: white;">
                    Survey-X ist nicht abgeschlossen. Das System wird mit den Wünschen der Kunden und unseren Ideen weiter ausgebaut und verbessert. Natürlich sind sämtlich updates für Kunden kostenfrei verwendbar.
                </p>
            </div>
            <div class="uk-width-1-3">
                <p style="color: white;">
                    Wir legen großen Wert auf Ordnungsgemäße Abwicklung der Umfrageb und Datenschutz. In unserer Verantwortung gegenüber den Teilnehmern werden alle Daten bis zu einem gewissen Grad anonymisiert.
                </p>
            </div>
            <div class="uk-width-1-3">
                <p style="color: white;">
                    Sollten trotz ausgiebiger Tests trotzdem einmal Fehler in das fertige System geraten bieten wir schnellstmögliche Hilfe und Wiederherstellung.
                </p>
            </div>
        </div>
        <br/>
        <br/>
    </div>
</div>

</body>
</html>