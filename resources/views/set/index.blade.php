@extends('app.interface')
@section('outlet')
    <div class="ui one column grid">
        <div class="column">
            <table class="ui orange striped table">
                <thead>
                <tr>
                    <th colspan="2"><h3>Sets</h3></th>
                </tr>
                <tr>
                    <th>Name</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @forelse($sets as $set)
                    <tr>
                        <td><a href="{{route('customer.set.facility.index', [$customer, $set])}}">{{$set->name}}</a></td>
                        <td>
                            <button id="launch-{{$set->id}}" class="ui labeled icon button"><i class="configure icon"></i> Bearbeiten</button>
                            <a class="rest ui red labeled icon button" data-method="DELETE" href="{{route('customer.set.destroy', [$customer,$set]).'?_token='.csrf_token()}}"><i class="trash icon"></i> Löschen</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2">
                            <h5>
                                Keine Sets gespeichert
                            </h5>
                            <p>
                                Um Teilnehmer hinzuzufügen erstellen sie bitte ein neues Set.
                            </p>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div id="launcher" class="ui right floated primary labeled icon button">
                <i class="plus icon"></i> Neues Set
            </div>
        </div>
    </div>
    @include('set._create-modal')
    @include('set._edit-modals')
@stop
@section('js')
    <script>
        $('#set')
                .modal('attach events', '#launcher', 'show')
        ;
        @foreach($sets as $set)
        $('#edit-{{$set->id}}')
                .modal('attach events', '#launch-{{$set->id}}', 'show')
        ;
        @endforeach
        $('#set')
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
