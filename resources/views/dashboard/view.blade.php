@extends('app.interface')
@section('outlet')
    <div class="ui two column grid">
        <div class="column">
            <h5 class="ui top attached header">
				{{ trans('if.dash.head1') }}
            </h5>
            <div class="ui purple attached segment">
                <div class="ui list">
                    @forelse($questionnaires as $questionnaire)
                        <a class="item" href="">{{$questionnaire->name}}</a>
                    @empty
                        <div class="item">
                            {{ trans('if.dash.body1') }} <br/>
                            {{ trans('if.dash.please') }} <strong><a href="{{route('customer.questionnaire.index', $customer)}}">{{ trans('if.dash.create') }}</a></strong> {{ trans('if.dash.end1') }}
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="column">
            <h5 class="ui top attached header">
                {{ trans('if.dash.head2') }}
            </h5>
            <div class="ui orange attached segment">
                <div class="ui list">
                    @forelse($sets as $set)
                        <a class="item" href="">{{$set->name}}</a>
                    @empty
                        <div class="item">
                            {{ trans('if.dash.body2') }} <br/>
                            {{ trans('if.dash.please') }} <strong><a href="{{route('customer.set.index', $customer)}}">{{ trans('if.dash.create') }}</a></strong> {{ trans('if.dash.end2') }}
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="column">
            <h5 class="ui top attached header">
                {{ trans('if.dash.head3') }}
            </h5>
            <div class="ui teal attached segment">
                <div class="ui list">
                    @forelse($surveys as $survey)
                        <a class="item" href="">{{$survey->name}}</a>
                    @empty
                        <div class="item">
                            {{ trans('if.dash.body3') }} <br/>
                            {{ trans('if.dash.please') }} <strong><a href="{{route('customer.survey.index', $customer)}}">{{ trans('if.dash.create') }}</a></strong> {{ trans('if.dash.end3') }}
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="column">
            <h5 class="ui top attached header">
                {{ trans('if.dash.head4') }}
            </h5>
            <div class="ui blue attached segment">
                <div class="ui list">
                    @forelse($results as $result)
                        <a class="item" href="">{{$result->name}}</a>
                    @empty
                        <div class="item">
                            {{ trans('if.dash.body4') }} <br/>
                            {{ trans('if.dash.please') }} <strong><a href="{{route('customer.questionnaire.index', $customer)}}">{{ trans('if.dash.create') }}</a></strong> {{ trans('if.dash.end4') }}
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="column">
            <button class="ui fluid green button" id="launcher">{{ trans('if.dash.edit') }}</button>
        </div>
    </div>
    @include('dashboard._settings-modal')
@stop
@section('js')
    <script>
        $('#settings')
                .modal('attach events', '#launcher', 'show')
        ;
        $( "#submit" ).click(function() {
            $( "#form" ).submit();
        });
    </script>
@stop