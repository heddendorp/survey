<div id="facility" class="ui modal">
    <div class="header">
        Neuer Standort
    </div>
    <div class="content">
        {!!Form::open(['class'=>'ui form', 'id'=>'form', 'route'=>['customer.set.facility.store', $customer, $set]])!!}
            <div class="required field">
                {!!Form::label('name', 'Titel')!!}
                <div class="ui icon input">
                    {!!Form::text('name')!!}
                    <i class="tag icon"></i>
                </div>
            </div>
        <div class="ui error message"></div>
        {!!Form::submit('Standort Speichern', ['class'=>'ui positive button'])!!}
        {!!Form::close()!!}
    </div>
    <div class="actions">
        <div class="ui black button">
            Verwerfen
        </div>
    </div>
</div>