@foreach($groups as $group)
    <div id="edit-{{$set->id}}" class="ui modal">
        <div class="header">
            {{$group->name}} {{ strtolower(trans('if.app.edit')) }}
        </div>
        <div class="content">
            {!!Form::model($group, ['class'=>'ui form', 'id'=>'form', 'method'=>'PATCH', 'route'=>['customer.set.facility.group.update', $customer, $set, $facility, $group]])!!}
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
                    {!!Form::select('type',[1=>trans('if.set.k1'), 2=>trans('if.set.k2')], null, ['class'=>'ui dropdown'])!!}
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
@endforeach