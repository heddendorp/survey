@foreach($groups as $group)
    <div id="edit-{{$set->id}}" class="ui modal">
        <div class="header">
            {{$group->name}} bearbeiten
        </div>
        <div class="content">
            {!!Form::model($group, ['class'=>'ui form', 'id'=>'form', 'method'=>'PATCH', 'route'=>['customer.set.facility.group.update', $customer, $set, $facility, $group]])!!}
            <div class="two fields">
                <div class="required field">
                    {!!Form::label('name', 'Titel')!!}
                    <div class="ui icon input">
                        {!!Form::text('name')!!}
                        <i class="tag icon"></i>
                    </div>
                </div>
                <div class="required field">
                    {!!Form::label('type', 'Typ')!!}
                    {!!Form::select('type',[1=>'Kindergarten', 2=>'Kinderkrippe'], null, ['class'=>'ui dropdown'])!!}
                </div>
            </div>
            <div class="ui error message"></div>
            {!!Form::submit('Set Speichern', ['class'=>'ui positive button'])!!}
            {!!Form::close()!!}
        </div>
        <div class="actions">
            <div class="ui black button">
                Verwerfen
            </div>
        </div>
    </div>
@endforeach