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