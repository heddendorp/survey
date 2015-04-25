<div id="user" class="ui modal">
    <div class="header">
		{{ trans('if.user.new') }}
    </div>
    <div class="content">
        {!!Form::open(['class'=>'ui form', 'id'=>'form', 'route'=>['customer.user.store', $customer]])!!}
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