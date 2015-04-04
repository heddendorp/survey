@extends('app.interface')
@section('outlet')
    <div class="ui one column grid">
        <div class="column">
            <table class="ui blue striped table">
                <thead>
                <tr>
                    <th colspan="3"><h3>Benutzer</h3></th>
                </tr>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            <button id="launch-{{$user->id}}" class="ui labeled icon button"><i class="configure icon"></i> Bearbeiten</button>
                            @if($user->admin == true)
                                <button class="ui disabled labeled icon button"><i class="trash icon"></i> Löschen</button>
                            @else
                                <a class="rest ui red labeled icon button" data-method="DELETE" href="{{route('customer.user.destroy', [$customer,$user]).'?_token='.csrf_token()}}"><i class="trash icon"></i> Löschen</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div id="launcher" class="ui right floated primary labeled icon button">
                <i class="user icon"></i> Neuer Benutzer
            </div>
        </div>
    </div>

    @include('user._edit-modals')
    @include('user._create-modal')
@stop
@section('js')
    <script>
        $('#user')
                .modal('attach events', '#launcher', 'show')
        ;
        @foreach($users as $user)
        $('#edit-{{$user->id}}')
                .modal('attach events', '#launch-{{$user->id}}', 'show')
        ;
        @endforeach
        $('#user')
                .form({
                    email: {
                        identifier  : 'email',
                        rules: [
                            {
                                type   : 'empty',
                                prompt : 'Bitte geben sie ihre Email ein.'
                            },
                            {
                                type   : 'email',
                                prompt : 'Email-Adresse ist nicht korrekt.'
                            }
                        ]
                    },
                    name: {
                        identifier  : 'name',
                        rules: [
                            {
                                type   : 'empty',
                                prompt : 'Bitte geben sie einen Namen ein.'
                            },
                            {
                                type   : 'length[3]',
                                prompt : 'Der Name muss mindestens drei Zeichen lang sein.'
                            }
                        ]
                    },
                    password: {
                        identifier  : 'password',
                        rules: [
                            {
                                type   : 'empty',
                                prompt : 'Bitte geben sie ein Passwort ein.'
                            },
                            {
                                type   : 'length[8]',
                                prompt : 'Das Passwort muss mindestens acht Zeichen lang sein.'
                            }
                        ]
                    },
                    password_confirmation: {
                        identifier  : 'password_confirmation',
                        rules: [
                            {
                                type   : 'match[password]',
                                prompt : 'Die Passwörter müssen übereinstimmen.'
                            }
                        ]
                    },
                })
        ;
    </script>
@stop