<div id="group" class="ui modal">
    <div class="header">
		{{ trans('if.set.new3') }}
    </div>
    <div class="content">
        {!!Form::open(['class'=>'ui form', 'id'=>'form', 'route'=>['customer.set.facility.group.store', $customer, $set, $facility]])!!}
            <div class="two fields">
                <div class="required field">
                    {!!Form::label('name', trans('if.app.title'))!!}
                    <div class="ui icon input">
                        {!!Form::text('name')!!}
                        <i class="tag icon"></i>
                    </div>
                </div>
                <div class="required field">
                    {!!Form::label('type', trans('if.app.type'))!!}
                    {!!Form::select('type',[""=>"Typ", 1=>trans('if.set.k1'), 2=>trans('if.set.k2')], null, ['class'=>'ui dropdown'])!!}
                </div>
            </div>
        <div class="ui error message"></div>
        {!!Form::submit(trans('if.set.save_loc'), ['class'=>'ui positive button'])!!}
        {!!Form::close()!!}
    </div>
    <div class="actions">
        <div class="ui black button">
			{{ trans('if.app.back') }}
        </div>
    </div>
</div>