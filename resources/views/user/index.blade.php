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

    @foreach($users as $user)
        <div id="edit-{{$user->id}}" class="ui modal">
            <div class="header">
                {{$user->name}} bearbeiten
            </div>
            <div class="content">
                {!!Form::model($user, ['class'=>'ui form', 'method'=>'PATCH', 'id'=>'form', 'route'=>['customer.user.update', $customer, $user]])!!}
                <div class="two fields">
                    <div class="required field">
                        {!!Form::label('email', 'Email-Adresse')!!}
                        <div class="ui icon input">
                            {!!Form::email('email')!!}
                            <i class="mail icon"></i>
                        </div>
                    </div>
                    <div class="required field">
                        {!!Form::label('name','Name')!!}
                        <div class="ui icon input">
                            {!!Form::text('name')!!}
                            <i class="user icon"></i>
                        </div>
                    </div>
                </div>
                <div class="two fields">
                    <div class="required field">
                        {!!Form::label('password', 'Passwort')!!}
                        <div class="ui icon input">
                            {!!Form::password('password')!!}
                            <i class="lock icon"></i>
                        </div>
                    </div>
                    <div class="required field">
                        {!!Form::label('password_confirmation','Passwort bestätigen')!!}
                        <div class="ui icon input">
                            {!!Form::password('password_confirmation')!!}
                            <i class="lock icon"></i>
                        </div>
                    </div>
                    <p>Wenn sie ein neues Passwort eingeben, wird dies gespeichert.</p>
                    <h4 class="ui dividing header">Brechtigungen</h4>
                    @if($user->admin)
                        <p>Administrative Benutzer haben <strong>alle</strong> Brechtigungen.</p>
                        <br/>
                    @else
                        <div class="ui three column grid">
                            <div class="column">
                                <div class="ui checkbox">
                                    {!!Form::checkbox('role[survey.view]')!!}
                                    <label>Umfragen einsehen</label>
                                </div>
                                <div class="ui checkbox">
                                    {!!Form::checkbox('role[survey.create]')!!}
                                    <label>Umfragen erstellen</label>
                                </div>
                                <div class="ui checkbox">
                                    {!!Form::checkbox('role[survey.edit]')!!}
                                    <label>Umfragen bearbeiten</label>
                                </div>
                                <div class="ui checkbox">
                                    {!!Form::checkbox('role[survey.delete]')!!}
                                    <label>Umfragen löschen</label>
                                </div>
                            </div>
                            <div class="column">
                                <div class="ui checkbox">
                                    {!!Form::checkbox('role[questionnaire.view]')!!}
                                    <label>Fragebögen einsehen</label>
                                </div>
                                <div class="ui checkbox">
                                    {!!Form::checkbox('role[questionnaire.create]')!!}
                                    <label>Fragebögen erstellen</label>
                                </div>
                                <div class="ui checkbox">
                                    {!!Form::checkbox('role[questionnaire.edit]')!!}
                                    <label>Fragebögen bearbeiten</label>
                                </div>
                                <div class="ui checkbox">
                                    {!!Form::checkbox('role[questionnaire.delete]')!!}
                                    <label>Fragebögen löschen</label>
                                </div>
                            </div>
                            <div class="column">
                                <div class="ui checkbox">
                                    {!!Form::checkbox('role[participant.view]')!!}
                                    <label>Teilnehmer einsehen</label>
                                </div>
                                <div class="ui checkbox">
                                    {!!Form::checkbox('role[participant.create]')!!}
                                    <label>Teilnehmer erstellen</label>
                                </div>
                                <div class="ui checkbox">
                                    {!!Form::checkbox('role[participant.edit]')!!}
                                    <label>Teilnehmer bearbeiten</label>
                                </div>
                                <div class="ui checkbox">
                                    {!!Form::checkbox('role[participant.delete]')!!}
                                    <label>Teilnehmer löschen</label>
                                </div>
                            </div>
                        </div>
                        <br/>
                    @endif
                </div>
                <div class="ui error message"></div>
                {!!Form::submit('Benutzer Speichern', ['class'=>'ui positive button'])!!}
                {!!Form::close()!!}
            </div>
            <div class="actions">
                <div class="ui black button">
                    Verwerfen
                </div>
            </div>
        </div>
        @endforeach

    <div id="user" class="ui modal">
        <div class="header">
            Neuer Benutzer
        </div>
        <div class="content">
            {!!Form::open(['class'=>'ui form', 'id'=>'form', 'route'=>['customer.user.store', $customer]])!!}
            <div class="two fields">
                <div class="required field">
                    {!!Form::label('email', 'Email-Adresse')!!}
                    <div class="ui icon input">
                        {!!Form::email('email')!!}
                        <i class="mail icon"></i>
                    </div>
                </div>
                <div class="required field">
                    {!!Form::label('name','Name')!!}
                    <div class="ui icon input">
                        {!!Form::text('name')!!}
                        <i class="user icon"></i>
                    </div>
                </div>
            </div>
            <div class="two fields">
                <div class="required field">
                    {!!Form::label('password', 'Passwort')!!}
                    <div class="ui icon input">
                        {!!Form::password('password')!!}
                        <i class="lock icon"></i>
                    </div>
                </div>
                <div class="required field">
                    {!!Form::label('password_confirmation','Passwort bestätigen')!!}
                    <div class="ui icon input">
                        {!!Form::password('password_confirmation')!!}
                        <i class="lock icon"></i>
                    </div>
                </div>
            </div>
            <div class="ui error message"></div>
            {!!Form::submit('Benutzer Speichern', ['class'=>'ui positive button'])!!}
            {!!Form::close()!!}
        </div>
        <div class="actions">
            <div class="ui black button">
                Verwerfen
            </div>
        </div>
    </div>
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