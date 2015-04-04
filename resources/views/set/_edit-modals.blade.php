@foreach($sets as $set)
    <div id="edit-{{$set->id}}" class="ui modal">
        <div class="header">
            {{$set->name}} bearbeiten
        </div>
        <div class="content">
            {!!Form::model($set, ['class'=>'ui form', 'id'=>'form', 'method'=>'PATCH', 'route'=>['customer.set.update', $customer, $set]])!!}
            <div class="required field">
                {!!Form::label('name', 'Titel')!!}
                <div class="ui icon input">
                    {!!Form::text('name')!!}
                    <i class="tag icon"></i>
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