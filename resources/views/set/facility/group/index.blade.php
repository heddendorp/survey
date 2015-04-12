@extends('app.interface')
@section('outlet')
    <div class="ui one column grid">
        <div class="column">
            <table class="ui orange striped table">
                <thead>
                <tr>
                    <th colspan="3"><h3>Gruppen</h3></th>
                </tr>
                <tr>
                    <th>Name</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @forelse($groups as $group)
                    <tr>
                        <td><a href="{{route('customer.set.facility.group.child.index', [$customer, $set, $facility, $group])}}">{{$group->name}}</a></td>
                        <td>{{$group->stringtype}}</td>
                        <td>
                            <button id="launch-{{$group->id}}" class="ui labeled icon button"><i class="configure icon"></i> Bearbeiten</button>
                            <a class="rest ui red labeled icon button" data-method="DELETE" href="{{route('customer.set.facility.group.destroy', [$customer,$set,$facility, $group]).'?_token='.csrf_token()}}"><i class="trash icon"></i> Löschen</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2">
                            <h5>
                                Keine Gruppen gespeichert
                            </h5>
                            <p>
                                Um Teilnehmer hinzuzufügen erstellen sie bitte eine neue Gruppe.
                            </p>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div id="launcher" class="ui right floated primary labeled icon button">
                <i class="plus icon"></i> Neue Gruppe
            </div>
        </div>
    </div>
    @include('set.facility.group._create-modal')
    @include('set.facility.group._edit-modals')
 @stop
 @section('js')
     <script>

         $('#group')
                 .modal('attach events', '#launcher', 'show')
         ;
         @foreach($groups as $group)
         $('#edit-{{$group->id}}')
                 .modal('attach events', '#launch-{{$group->id}}', 'show')
         ;
         @endforeach
         $('#group')
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
                     },
                     type: {
                         identifier: 'type',
                         rules: [
                             {
                                 type: 'empty',
                                 prompt: 'Bitte wählen sie einen Typ für die Gruppe die sie erstellen.'
                             }
                         ]
                     }
                 })
         ;
     </script>

@stop
