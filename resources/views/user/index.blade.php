@extends('partials.app')
@section('head-style')
    style="background: url({{asset('img/pattern.png')}});"
@stop
@section('header')
    @include('partials.nav')
@stop
@section('helptext')
    Hier werden alle Benutzer aufgelistet die im Moment Zugang zu Fragebögen und/oder Auswertungen ihrer Firma haben.
@stop
@section('content')
    <div class="uk-container uk-container-center">
        <div class="uk-panel uk-panel-box">
            <div class="uk-grid">
                <div class="width-1-2">
                    <h1>Benutzerübersicht</h1>
                </div>
            </div>
            <hr class="uk-grid-divider"/>
            <div class="uk-grid">
                <div class="uk-width-1-1">
                    <table class="uk-table">
                        <thead>
                        <tr>
                            <th>
                                Benutzername
                            </th>
                            <th>
                                Email-Adresse
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->username}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    <a href="{{route('customer.user.edit', [$customer,$user])}}" class="uk-button uk-button-primary">Bearbeiten</a>
                                </td>
                                <td>
                                    @if($user->role["admin"])
                                        <span class="uk-text-danger">
                                            Dieser benutzer kann nicht gelöscht werden.
                                        </span>
                                    @else
                                        <a href="{{route('customer.user.destroy', [$customer,$user]).'?_token='.csrf_token()}}" class="rest uk-button uk-button-danger" data-method="DELETE">Löschen <i class="fa fa-trash-o"></i> </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop