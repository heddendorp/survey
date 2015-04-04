<div id="set" class="ui modal">
    <div class="header">
        Neues Set
    </div>
    <div class="content">
        {!!Form::open(['class'=>'ui form', 'id'=>'form', 'route'=>['customer.set.store', $customer]])!!}
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