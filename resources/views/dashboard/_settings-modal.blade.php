<div id="settings" class="ui modal">
    <div class="header">
        Firmendaten
    </div>
    <div class="content">
        <div class="ui middle aligned medium image">
            <img src="{{$customer->logo}}" alt="Logo"/>
        </div>
        <div class="description">
            {!!Form::model($customer,['class'=>'ui form', 'method'=>'PUT', 'id'=>'form', 'route'=>['customer.update',$customer]])!!}
            <div class="field">
                {!!Form::label('logo','Logo-URL')!!}
                <div class="ui input">
                    {!!Form::text('logo')!!}
                </div>
            </div>
            <div class="field">
                {!!Form::label('name','Firmenname')!!}
                <div class="ui input">
                    {!!Form::text('name')!!}
                </div>
            </div>
            <div class="field">
                {!!Form::label('info_email','Info-Adresse')!!}
                <div class="ui input">
                    {!!Form::email('info_email')!!}
                </div>
            </div>
            {!!Form::close()!!}
        </div>
    </div>
    <div class="actions">
        <div class="ui black button">
            Verwerfen
        </div>
        <div id="submit" class="ui positive right labeled icon button">
            Speichern
            <i class="checkmark icon"></i>
        </div>
    </div>
</div>