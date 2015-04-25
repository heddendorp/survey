@extends('app.interface')
@section('outlet')
    <div class="ui one column grid">
        <div class="column">
            <table class="ui orange striped table">
                <thead>
                <tr>
                    <th colspan="2"><h3>{{ trans('if.set.loc') }}</h3></th>
                </tr>
                <tr>
                    <th>{{ trans('if.app.name') }}</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @forelse($facilities as $facility)
                    <tr>
                        <td><a href="{{route('customer.set.facility.group.index', [$customer, $set, $facility])}}">{{$facility->name}}</a></td>
                        <td>
                            <button id="launch-{{$facility->id}}" class="ui labeled icon button"><i class="configure icon"></i> {{ trans('if.app.edit') }}</button>
                            <a class="rest ui red labeled icon button" data-method="DELETE" href="{{route('customer.set.facility.destroy', [$customer,$set,$facility]).'?_token='.csrf_token()}}"><i class="trash icon"></i> {{ trans('if.app.delete') }}</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2">
                            <h5>
								{{ trans('if.set.saved2') }}
                            </h5>
                            <p>
								{{ trans('if.set.to_add2') }}
                            </p>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div id="launcher" class="ui right floated primary labeled icon button">
                <i class="plus icon"></i> {{ trans('if.set.new2') }}
            </div>
        </div>
    </div>

    @include('set.facility._create-modal')
    @include('set.facility._edit-modals')
@stop
@section('js')
    <script>
        $('#facility')
                .modal('attach events', '#launcher', 'show')
        ;
        @foreach($facilities as $facility)
        $('#edit-{{$facility->id}}')
                .modal('attach events', '#launch-{{$facility->id}}', 'show')
        ;
        @endforeach
        $('#facility')
                .form({
                    name: {
                        identifier: 'name',
                        rules: [
                            {
                                type: 'empty',
                                prompt: {!! trans('if.set.title_req') !!}
                            },
                            {
                                type: 'length[3]',
                                prompt: {!! trans('if.set.title_len') !!}
                            }
                        ]
                    }
                })
        ;

    </script>
@stop
