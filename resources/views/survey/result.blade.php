@extends('partials.app')
@section('head-style')
    style="background: url({{asset('img/pattern.png')}});"
@stop
@section('header')
    @include('partials.nav')
@stop
@section('sidenav')
    <li><a href="{{route('customer.show', $customer)}}">Zurück zu Übersicht</a></li>
    <li><a href="{{route('customer.survey.index', $customer)}}">Alle Umfragen</a></li>
    <li class="uk-parent">
        <a href="#">Hilfe zu diesem Fenster</a>
        <ul class="uk-nav-sub">
            <li><p></p></li>
        </ul>
    </li>
@stop
@section('content')
    <div class="uk-container uk-container-center">
        <div class="uk-panel uk-panel-box">
            <div class="uk-grid">
                <div class="uk-width-1-1">
                    <h1>Auswertung für {{$result->group_name}}/<small>{{$result->facility_name}}</small></h1>
                </div>
            </div>
            <div class="uk-grid">
                @foreach($result->data as $section)
                    <div class="uk-width-1-1">
                        <hr class="uk-grid-divider"/>
                        <h3>{{$section['name']}}</h3>
                        <div class="uk-grid">
                            @foreach($section['questiongroups'] as $questiongroup)
                                <div class="uk-width-1-2">
                                    <h4>{{$questiongroup['name']}}</h4>
                                    <div class="uk-grid">
                                        @if($questiongroup['type'] == 1)
                                            @if(isset($questiongroup['answers']))
                                                @foreach($questiongroup['answers'] as $answer)
                                                    <div class="uk-width-1-1">
                                                        <span>{{$answer}}</span>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="uk-width-1-1">
                                                    <span>Es wurden keine Antworten abgegeben.</span>
                                                </div>
                                            @endif
                                        @elseif($questiongroup['type'] == 2)
                                            @foreach($questiongroup['answers'] as $answer)
                                                <div class="uk-width-1-2">
                                                    {{$answer['vote']}}
                                                </div>
                                                <div class="uk-width-1-2">
                                                    <span class="uk-badge">{{$answer['absolut']}}</span>&nbsp;<span class="uk-badge">{{$answer['percent']}}%</span>
                                                </div>
                                            @endforeach
                                        @elseif($questiongroup['type'] == 3)
                                            <div class="uk-width-1-1">
                                                <table class="uk-table">
                                                    <thead>
                                                    <tr>
                                                        <th>Option</th>
                                                        <th>Enthaltung</th>
                                                        <th>1</th>
                                                        <th>2</th>
                                                        <th>3</th>
                                                        <th>4</th>
                                                        <th>5</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($questiongroup['answers'] as $answer)
                                                        <tr>
                                                            <td>{{$answer['name']}}</td>
                                                            @foreach($answer['votes'] as $vote)
                                                                <td><span class="uk-badge">{{$vote['absolut']}}</span>&nbsp;<span class="uk-badge">{{$vote['percent']}}%</span></td>
                                                            @endforeach
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endif
                                    </div>
                                    <hr class="uk-grid-divider"/>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@stop