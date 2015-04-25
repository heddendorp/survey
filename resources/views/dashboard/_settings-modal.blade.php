<div id="settings" class="ui modal">
    <div class="header">
		{{ trans('if.dash.edit') }}
    </div>
    <div class="content">
        <div class="ui middle aligned medium image">
            <img src="{{$customer->logo}}" alt="Logo"/>
        </div>
        <div class="description">
            {!!Form::model($customer,['class'=>'ui form', 'method'=>'PUT', 'id'=>'form', 'route'=>['customer.update',$customer]])!!}
            <div class="field">
                {!!Form::label('logo',trans('if.dash.logo'))!!}
                <div class="ui input">
                    {!!Form::text('logo')!!}
                </div>
            </div>
            <div class="field">
                {!!Form::label('name',trans('if.dash.name'))!!}
                <div class="ui input">
                    {!!Form::text('name')!!}
                </div>
            </div>
            <div class="field">
                {!!Form::label('info_email',trans('if.dash.addr'))!!}
                <div class="ui input">
                    {!!Form::email('info_email')!!}
                </div>
            </div>
            {!!Form::close()!!}
        </div>
    </div>
    <div class="actions">
        <div class="ui black button">
			{{ trans('if.app.back') }}
        </div>
        <div id="submit" class="ui positive right labeled icon button">
            {{ trans('if.app.save') }}
            <i class="checkmark icon"></i>
        </div>
    </div>
</div>