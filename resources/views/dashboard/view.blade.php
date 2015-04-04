@extends('app.interface')
@section('outlet')
    <div class="ui two column grid">
        <div class="column">
            <h5 class="ui top attached header">
                Zuletst bearbeitete Fragebögen
            </h5>
            <div class="ui purple attached segment">
                <p>
                <ol>
                    <li>Frgabeogen 1</li>
                    <li>Fragebogen 2</li>
                </ol>
                </p>
            </div>
        </div>
        <div class="column">
            <h5 class="ui top attached header">
                Zuletst bearbeitete Teilnehmer
            </h5>
            <div class="ui orange attached segment">
                <p>Lalalal</p>
            </div>
        </div>
        <div class="column">
            <h5 class="ui top attached header">
                Zuletst bearbeitete Umfragen
            </h5>
            <div class="ui teal attached segment">
                <p>Lalalal</p>
            </div>
        </div>
        <div class="column">
            <h5 class="ui top attached header">
                Neueste Ergebnisse
            </h5>
            <div class="ui blue attached segment">
                <p>Lalalal</p>
            </div>
        </div>
        <div class="column">
            <button class="ui fluid green button" id="launcher">Firmendaten ändern</button>
        </div>
    </div>
    @include('dashboard._settings-modal')
@stop
@section('js')
    <script>
        $('#settings')
                .modal('attach events', '#launcher', 'show')
        ;
        $( "#submit" ).click(function() {
            $( "#form" ).submit();
        });
    </script>
@stop