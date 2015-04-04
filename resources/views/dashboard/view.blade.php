@extends('app.interface')
@section('outlet')
    <div class="ui two column grid">
        <div class="column">
            <h5 class="ui top attached header">
                Zuletst bearbeitete Fragebögen
            </h5>
            <div class="ui purple attached segment">
                <div class="ui list">
                    @forelse($questionnaires as $questionnaire)
                        <a class="item" href="">{{$questionnaire->name}}</a>
                    @empty
                        <div class="item">
                            Keine Fragebögen gespeichert. <br/>
                            Bitte <strong><a href="{{route('customer.questionnaire.index', $customer)}}">erstellen</a></strong> sie einen neuen Fragebogen.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="column">
            <h5 class="ui top attached header">
                Zuletst bearbeitete Teilnehmer
            </h5>
            <div class="ui orange attached segment">
                <div class="ui list">
                    @forelse($sets as $set)
                        <a class="item" href="">{{$set->name}}</a>
                    @empty
                        <div class="item">
                            Keine Teilnehmer gespeichert. <br/>
                            Bitte <strong><a href="{{route('customer.set.index', $customer)}}">erstellen</a></strong> sie ein neues Set um Teilnehmer hinzuzufügen.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="column">
            <h5 class="ui top attached header">
                Zuletst bearbeitete Umfragen
            </h5>
            <div class="ui teal attached segment">
                <div class="ui list">
                    @forelse($surveys as $survey)
                        <a class="item" href="">{{$survey->name}}</a>
                    @empty
                        <div class="item">
                            Keine Umfragen gespeichert. <br/>
                            Bitte <strong><a href="{{route('customer.survey.index', $customer)}}">erstellen</a></strong> sie eine neue Umfrage.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="column">
            <h5 class="ui top attached header">
                Neueste Ergebnisse
            </h5>
            <div class="ui blue attached segment">
                <div class="ui list">
                    @forelse($results as $result)
                        <a class="item" href="">{{$result->name}}</a>
                    @empty
                        <div class="item">
                            Keine Ergebnisse gespeichert. <br/>
                            Bitte <strong><a href="{{route('customer.questionnaire.index', $customer)}}">erstellen</a></strong> sie ein Ergebnis.
                        </div>
                    @endforelse
                </div>
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