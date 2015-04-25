@extends('app.main')
@section('body')
    <div style="margin-top: 12em;"></div>
    <div class="ui two column centered grid">
        <div class="column">
            <div class="ui green segment">
                {!!Form::open(array('action'=>'WelcomeController@authenticate','class'=>'ui form'))!!}
                <h4 class="ui dividing header">{{ trans('if.app.login') }}</h4>
                <div class="two fields">
                    <div class="required field">
                        {!!Form::label('email', trans('if.app.email'))!!}
                        <div class="ui icon input">
                            {!!Form::email('email', null, ['placeholder'=>'beispiel@gmail.com'])!!}
                            <i class="mail icon"></i>
                        </div>
                    </div>
                    <div class="required field">
                        {!!Form::label('password',trans('if.app.pass'))!!}
                        <div class="ui icon input">
                            {!!Form::password('password')!!}
                            <i class="lock icon"></i>
                        </div>
                    </div>
                </div>
                <div class="field">
                    <div class="ui toggle checkbox">
                        {!!Form::checkbox('remember')!!}
                        {!!Form::label('remember', trans('if.app.rem'))!!}
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
                                prompt : {!! trans('if.user.e_req')
                            },
                            {
                                type   : 'email',
                                prompt : {!! trans('if.user.e_is')
                            }
                        ]
                    },
                    password: {
                        identifier  : 'password',
                        rules: [
                            {
                                type   : 'empty',
                                prompt : {!! trans('if.user.p_req')
                            }
                        ]
                    },
                })
        ;
    </script>
@stop