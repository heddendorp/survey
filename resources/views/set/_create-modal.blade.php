<div id="set" class="ui modal">
    <div class="header">
		{{ trans('if.set.new') }}
    </div>
    <div class="content">
        {!!Form::open(['class'=>'ui form', 'id'=>'form', 'route'=>['customer.set.store', $customer]])!!}
            <div class="required field">
                {!!Form::label('name', trans('if.app.title'))!!}
                <div class="ui icon input">
                    {!!Form::text('name')!!}
                    <i class="tag icon"></i>
                </div>
            </div>
        <div class="ui error message"></div>
        {!!Form::submit(trans('if.set.set'), ['class'=>'ui positive button'])!!}
        {!!Form::close()!!}
    </div>
    <div class="actions">
        <div class="ui black button">
			{{ trans('if.app.back') }}
        </div>
    </div>
</div>