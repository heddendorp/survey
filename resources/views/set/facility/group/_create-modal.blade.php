<div id="group" class="ui modal">
    <div class="header">
        Neue Gruppe
    </div>
    <div class="content">
        {!!Form::open(['class'=>'ui form', 'id'=>'form', 'route'=>['customer.set.facility.group.store', $customer, $set, $facility]])!!}
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
                    {!!Form::select('type',[""=>"Typ", 1=>'Kindergarten', 2=>'Kinderkrippe'], null, ['class'=>'ui dropdown'])!!}
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