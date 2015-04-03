@extends('app.main')
@section('outlet')
    <div style="margin-top: 12em;"></div>
    <div class="ui four column centered grid">
        <div class="column">
            <div class="ui green segment">
                {!!Form::open(array('action'=>'WelcomeController@authenticate','class'=>'ui form'))!!}
                <h4 class="ui dividing header">Login</h4>
                <div class="two fields">
                    <div class="required field">
                        {!!Form::label('email', 'Email-Adresse')!!}
                        <div class="ui icon input">
                            {!!Form::email('email', 'beispiel@gmail.com')!!}
                            <i class="mail icon"></i>
                        </div>
                    </div>
                    <div class="required field">
                        {!!Form::label('password','Passwort')!!}
                        <div class="ui icon input">
                            {!!Form::password('password')!!}
                            <i class="lock icon"></i>
                        </div>
                    </div>
                </div>
                <div class="field">
                    <div class="ui toggle checkbox">
                        {!!Form::checkbox('remember')!!}
                        {!!Form::label('remember', 'Angemeldet bleiben')!!}
                    </div>
                </div>
                {!!Form::submit('Anmelden',array('class'=>'ui green submit button'))!!}
                <div class="ui @if($errors->has('login')) visible @endif error message">
                    @if($errors->has('login'))
                        <ul class="list">
                            <li>{{$errors->first('login')}}</li>
                        </ul>
                    @endif
                </div>
                {!!Form::close()!!}
            </div>
        </div>
    </div>
@stop
@section('js')
    <script>
        $('.ui.checkbox')
                .checkbox()
        ;
        $('.ui.form')
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
                    password: {
                        identifier  : 'password',
                        rules: [
                            {
                                type   : 'empty',
                                prompt : 'Bitte geben sie ihr Passwort ein.'
                            }
                        ]
                    },
                })
        ;
    </script>
@stop