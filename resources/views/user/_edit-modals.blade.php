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