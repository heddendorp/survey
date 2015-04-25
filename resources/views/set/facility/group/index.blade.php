@extends('app.interface')
@section('outlet')
    <div class="ui one column grid">
        <div class="column">
            <table class="ui orange striped table">
                <thead>
                <tr>
                    <th colspan="3"><h3>{{ trans('if.set.groups') }}</h3></th>
                </tr>
                <tr>
                    <th>{{ trans('if.app.name') }}</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @forelse($groups as $group)
                    <tr>
                        <td><a href="{{route('customer.set.facility.group.child.index', [$customer, $set, $facility, $group])}}">{{$group->name}}</a></td>
                        <td>{{$group->stringtype}}</td>
                        <td>
                            <button id="launch-{{$group->id}}" class="ui labeled icon button"><i class="configure icon"></i> {{ trans('if.app.edit') }}</button>
                            <a class="rest ui red labeled icon button" data-method="DELETE" href="{{route('customer.set.facility.group.destroy', [$customer,$set,$facility, $group]).'?_token='.csrf_token()}}"><i class="trash icon"></i> {{ trans('if.app.delete') }}</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2">
                            <h5>
								{{ trans('if.set.saved3') }}
                            </h5>
                            <p>
							{{ trans('if.set.to_add3')	}}
                            </p>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div id="launcher" class="ui right floated primary labeled icon button">
                <i class="plus icon"></i> {{ trans('if.set.new3') }}
            </div>
        </div>
    </div>
    @include('set.facility.group._create-modal')
    @include('set.facility.group._edit-modals')
 @stop
 @section('js')
     <script>

         $('#group')
                 .modal('attach events', '#launcher', 'show')
         ;
         @foreach($groups as $group)
         $('#edit-{{$group->id}}')
                 .modal('attach events', '#launch-{{$group->id}}', 'show')
         ;
         @endforeach
         $('#group')
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
                     },
                     type: {
                         identifier: 'type',
                         rules: [
                             {
                                 type: 'empty',
                                 prompt: {!! trans('if.set.type_req') !!}
                             }
                         ]
                     }
                 })
         ;
     </script>

@stop
