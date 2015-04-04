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

    <div id="settings" class="ui modal">
        <div class="header">
            Firmendaten
        </div>
        <div class="content">
            <div class="ui middle aligned medium image">
                <img src="{{$customer->logo}}" alt="Logo"/>
            </div>
            <div class="description">
                {!!Form::model($customer,['class'=>'ui form', 'method'=>'PUT', 'id'=>'form', 'route'=>['customer.update',$customer]])!!}
                <div class="field">
                    {!!Form::label('logo','Logo-URL')!!}
                    <div class="ui input">
                        {!!Form::text('logo')!!}
                    </div>
                </div>
                <div class="field">
                    {!!Form::label('name','Firmenname')!!}
                    <div class="ui input">
                        {!!Form::text('name')!!}
                    </div>
                </div>
                <div class="field">
                    {!!Form::label('info_email','Info-Adresse')!!}
                    <div class="ui input">
                        {!!Form::email('info_email')!!}
                    </div>
                </div>
                {!!Form::close()!!}
            </div>
        </div>
        <div class="actions">
            <div class="ui black button">
                Verwerfen
            </div>
            <div id="submit" class="ui positive right labeled icon button">
                Speichern
                <i class="checkmark icon"></i>
            </div>
        </div>
    </div>
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