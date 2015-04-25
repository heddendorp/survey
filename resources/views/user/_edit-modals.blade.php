@foreach($users as $user)
    <div id="edit-{{$user->id}}" class="ui modal">
        <div class="header">
            {{$user->name}} {{ strtolower(trans('if.app.edit')) }}
        </div>
        <div class="content">
            {!!Form::model($user, ['class'=>'ui form', 'method'=>'PATCH', 'id'=>'form', 'route'=>['customer.user.update', $customer, $user]])!!}
            <div class="two fields">
                <div class="required field">
                    {!!Form::label('email', trans('if.app.email'))!!}
                    <div class="ui icon input">
                        {!!Form::email('email')!!}
                        <i class="mail icon"></i>
                    </div>
                </div>
                <div class="required field">
                    {!!Form::label('name',trans('if.app.name'))!!}
                    <div class="ui icon input">
                        {!!Form::text('name')!!}
                        <i class="user icon"></i>
                    </div>
                </div>
            </div>
            <div class="two fields">
                <div class="required field">
                    {!!Form::label('password', trans('if.app.pass'))!!}
                    <div class="ui icon input">
                        {!!Form::password('password')!!}
                        <i class="lock icon"></i>
                    </div>
                </div>
                <div class="required field">
                    {!!Form::label('password_confirmation',trans('if.app.pass_conf'))!!}
                    <div class="ui icon input">
                        {!!Form::password('password_confirmation')!!}
                        <i class="lock icon"></i>
                    </div>
                </div>
                <p>{{ trans('if.user.pass_store') }}</p>
                <h4 class="ui dividing header">{{ trans('if.user.@_@') }}</h4>
                @if($user->admin)
                    <p>{!! trans('if.user.oh_mein_gott') !!}</p>
                    <br/>
                @else
                    <div class="ui three column grid">
                        <div class="column">
                            <div class="ui checkbox">
                                {!!Form::checkbox('role[survey.view]')!!}
                                <label>{{ trans('if.user.poll_v') }}</label>
                            </div>
                            <div class="ui checkbox">
                                {!!Form::checkbox('role[survey.create]')!!}
                                <label>{{ trans('if.user.poll_c') }}</label>
                            </div>
                            <div class="ui checkbox">
                                {!!Form::checkbox('role[survey.edit]')!!}
                                <label>{{ trans('if.user.poll_e') }}</label>
                            </div>
                            <div class="ui checkbox">
                                {!!Form::checkbox('role[survey.delete]')!!}
                                <label>{{ trans('if.user.poll_d') }}</label>
                            </div>
                        </div>
                        <div class="column">
                            <div class="ui checkbox">
                                {!!Form::checkbox('role[questionnaire.view]')!!}
                                <label>{{ trans('if.user.que_v') }}</label>
                            </div>
                            <div class="ui checkbox">
                                {!!Form::checkbox('role[questionnaire.create]')!!}
                                <label>{{ trans('if.user.que_c')}}</label>
                            </div>
                            <div class="ui checkbox">
                                {!!Form::checkbox('role[questionnaire.edit]')!!}
                                <label>{{ trans('if.user.que_e') }}</label>
                            </div>
                            <div class="ui checkbox">
                                {!!Form::checkbox('role[questionnaire.delete]')!!}
                                <label>{{ trans('if.user.que_d') }}</label>
                            </div>
                        </div>
                        <div class="column">
                            <div class="ui checkbox">
                                {!!Form::checkbox('role[participant.view]')!!}
                                <label>{{ trans('if.user.par_v') }}</label>
                            </div>
                            <div class="ui checkbox">
                                {!!Form::checkbox('role[participant.create]')!!}
                                <label>{{ trans('if.user.par_c') }}</label>
                            </div>
                            <div class="ui checkbox">
                                {!!Form::checkbox('role[participant.edit]')!!}
                                <label>{{ trans('if.user.par_e') }}</label>
                            </div>
                            <div class="ui checkbox">
                                {!!Form::checkbox('role[participant.delete]')!!}
                                <label>{{ trans('if.user.par_d') }}</label>
                            </div>
                        </div>
                    </div>
                    <br/>
                @endif
            </div>
            <div class="ui error message"></div>
            {!!Form::submit(trans('if.user.save'), ['class'=>'ui positive button'])!!}
            {!!Form::close()!!}
        </div>
        <div class="actions">
            <div class="ui black button">
				{{ trans('if.app.back') }}
            </div>
        </div>
    </div>
@endforeach