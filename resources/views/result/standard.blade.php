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
    <li><a href="{{route('customer.survey.show', [$customer, $survey])}}">Umfrage ansehen</a></li>
    <li class="uk-parent">
        <a href="#">Hilfe zu diesem Fenster</a>
        <ul class="uk-nav-sub">
            <li><p>Hier sehen Sie die Auswertung der gewählten Gruppe. <small>Diese Ansicht wird sich im laufe der Entwicklung weiter verändern.</small></p></li>
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
                                <div class="uk-width-1-1">
                                    <h4>{{$questiongroup['name']}}</h4>
                                    <div class="uk-grid">
                                        @if($questiongroup['type'] == 1)
                                            @if(isset($questiongroup['answers']))
                                                <div class="uk-width-1-1">
                                                    <div class="uk-clearfix">
                                                        @foreach($questiongroup['answers'] as $answer)
                                                            @if($answer != "")
                                                                <p style="background-color: rgba(0,0,0,0.1);padding: 10px;">{{$answer}}</p>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
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
                                                    <div class="uk-grid">
                                                        <div class="uk-with-1-10">
                                                            {{$answer['absolut']}}
                                                        </div>
                                                        <div class="uk-width-1-10">
                                                            {{$answer['percent']}}%
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @elseif($questiongroup['type'] == 3)
                                            <div class="uk-width-1-1">
                                                <table class="uk-table uk-table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th>Option</th>
                                                        <th colspan="2">Enthaltung</th>
                                                        <th colspan="2">1</th>
                                                        <th colspan="2">2</th>
                                                        <th colspan="2">3</th>
                                                        <th colspan="2">4</th>
                                                        <th colspan="2">5</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($questiongroup['answers'] as $answer)
                                                        <tr>
                                                            <td style="width: 50%">{{$answer['name']}}</td>
                                                            @foreach($answer['votes'] as $vote)
                                                                <td>{{$vote['absolut']}}</td>
                                                                <td>{{$vote['percent']}}%</td>
                                                            @endforeach
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @elseif($questiongroup['type'] == 4)
                                            <div class="uk-width-1-1">
                                                <table class="uk-table">
                                                    <thead>
                                                    <tr>
                                                        <th colspan="2">1</th>
                                                        <th colspan="2">2</th>
                                                        <th colspan="2">3</th>
                                                        <th colspan="2">4</th>
                                                        <th colspan="2">5</th>
                                                        <th colspan="2">6</th>
                                                        <th colspan="2">7</th>
                                                        <th colspan="2">8</th>
                                                        <th colspan="2">9</th>
                                                        <th colspan="2">10</th>
                                                    </tr>
                                                    <tbody>
                                                    @foreach($questiongroup['answers'] as $answer)
                                                        <tr>
                                                            @foreach($answer['votes'] as $vote)
                                                                <td>{{$vote['absolut']}}</td>
                                                                <td>{{$vote['percent']}}%</td>
                                                            @endforeach
                                                        </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td colspan="20">NPS={{$questiongroup['mps']}}%</td>
                                                    </tr>
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