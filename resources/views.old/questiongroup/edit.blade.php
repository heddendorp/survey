@extends('partials.app')
@section('head-style')
    style="background: url({{asset('img/pattern.png')}});"
@stop
@section('header')
    @include('partials.nav')
@stop
@section('helptext')
    Hilfetext fehlt
@stop
@section('content')
    <div class="uk-container uk-container-center">
        <form class="uk-panel uk-panel-box uk-form" method="POST" action="{{route('customer.questionnaire.section.questiongroup.update', [$customer, $questionnaire, $section, $questiongroup])}}">
            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            <input type="hidden" name="type" value="{{$questiongroup->type}}"/>
            <input type="hidden" name="_method" value="PATCH"/>
            <fieldset>
                <legend>Neue Frage</legend>
                <div class="uk-grid">
                    <div class="uk-width-1-2">
                        <input class="uk-width-1-1 uk-form-large" type="text" name="heading" placeholder="Frage" value="{{$questiongroup->heading}}">
                        <p class="uk-form-help-block uk-text-danger">{{$errors->first('heading')}}</p>
                    </div>
                    <div class="uk-width-1-2">
                        <span class="uk-form-help-inline uk-margin-top"><span class="uk-text-primary">{{$questiongroup->stringType()}}</span>&nbsp;Die Art der Frage kann nicht verändert werden.</span>
                    </div>
                    <div class="uk-width-1-1">
                        <div class="uk-grid">
                            <div class="uk-width-1-2">
                                <span class="uk-form-help-inline uk-margin-top uk-float-right">Die Frage nur bei bestimmten Teilnehmern anzeigen</span>
                            </div>
                            <div class="uk-width-1-2">
                                <select name="condition" class="uk-form-large uk-width-1-1">
                                    <option @if($questiongroup->condition == 1) selected @endif value="1">Bei allen Teilnehmern</option>
                                    <option @if($questiongroup->condition == 2) selected @endif value="2">Nur bei Kindern in der Krippe</option>
                                    <option @if($questiongroup->condition == 3) selected @endif value="3">Nur bei Kindern im Kindergarten</option>
                                </select>
                                <p class="uk-form-help-block uk-text-danger">{{$errors->first('intern')}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
            @if($questiongroup->type == 2 || $questiongroup->type == 3)
                <fieldset>
                    <legend>Optionen</legend>
                    <div id="wählen">
                        @foreach($questions as $question)
                            <div class="uk-form-row">
                                <input class="uk-form-width-large uk-form-large" type="text" name="questions[{{$question->id}}]" placeholder="Option" value="{{$question->content}}"><a onclick="function(e){ //user click on remove text
                        e.preventDefault();
                        $(this).parent('div').remove();
                    }" href="" class="uk-close"></a>
                            </div>
                        @endforeach
                    </div>
                    <div class="uk-form-row">
                        <button id="new" class="uk-button uk-button-success uk-margin-top" type="submit">Neue Option</button>
                    </div>
                </fieldset>
            @endif
            <div class="uk-form-row uk-margin-top">
                <button type="submit" class="uk-width-1-1 uk-button uk-button-primary uk-button-large">Speichern</button>
            </div>
        </form>
@stop
@section('footer')
            <script>
                $(function() {
                    var wrapper         = $("#wählen"); //Fields wrapper
                    var add_button      = $("#new"); //Add button ID

                    var x = 1; //initlal text box count
                    $(add_button).click(function(e){ //on add input button click
                        e.preventDefault();
                        $(wrapper).append('<div class="uk-form-row"><input name="options[]" class="uk-form-width-large uk-form-large" type="text"/><a href="" class="uk-close"></a></div>'); //add input box
                    });

                    $(wrapper).on("click",".uk-close", function(e){ //user click on remove text
                        e.preventDefault();
                        $(this).parent('div').remove();
                    })
                });
            </script>
@stop