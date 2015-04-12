@extends('app.interface')
@section('outlet')
    <div class="ui one column grid">
        <div class="column">
            <table class="ui orange striped table">
                <thead>
                <tr>
                    <th colspan="2"><h3>Standorte</h3></th>
                </tr>
                <tr>
                    <th>Name</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @forelse($facilities as $facility)
                    <tr>
                        <td><a href="{{route('customer.set.facility.group.index', [$customer, $set, $facility])}}">{{$facility->name}}</a></td>
                        <td>
                            <button id="launch-{{$facility->id}}" class="ui labeled icon button"><i class="configure icon"></i> Bearbeiten</button>
                            <a class="rest ui red labeled icon button" data-method="DELETE" href="{{route('customer.set.facility.destroy', [$customer,$set,$facility]).'?_token='.csrf_token()}}"><i class="trash icon"></i> Löschen</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2">
                            <h5>
                                Keine Standorte gespeichert
                            </h5>
                            <p>
                                Um Teilnehmer hinzuzufügen erstellen sie bitte einen neuen Standort.
                            </p>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div id="launcher" class="ui right floated primary labeled icon button">
                <i class="plus icon"></i> Neuer Standort
            </div>
        </div>
    </div>

    @include('set.facility._create-modal')
    @include('set.facility._edit-modals')
@stop
@section('js')
    <script>
        $('#facility')
                .modal('attach events', '#launcher', 'show')
        ;
        @foreach($facilities as $facility)
        $('#edit-{{$facility->id}}')
                .modal('attach events', '#launch-{{$facility->id}}', 'show')
        ;
        @endforeach
        $('#facility')
                .form({
                    name: {
                        identifier: 'name',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'Bitte geben sie einen Titel ein.'
                            },
                            {
                                type: 'length[3]',
                                prompt: 'Der Titel muss mindestens drei Zeichen lang sein.'
                            }
                        ]
                    }
                })
        ;

    </script>
@stop
