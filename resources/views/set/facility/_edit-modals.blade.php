@foreach($facilities as $facility)
    <div id="edit-{{$facility->id}}" class="ui modal">
        <div class="header">
            {{$facility->name}} {{ strtolower(trans('if.app.edit')) }}
        </div>
        <div class="content">
            {!!Form::model($facility, ['class'=>'ui form', 'id'=>'form', 'method'=>'PATCH', 'route'=>['customer.set.facility.update', $customer, $set, $facility]])!!}
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
@endforeach