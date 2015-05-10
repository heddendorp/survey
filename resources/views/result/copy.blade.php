@extends('partials.excel')
@section('head-style')
    style="background: url({{asset('img/pattern.png')}});"
@stop
@section('content')
    <div class="uk-container uk-container-center uk-margin-large-top">
        <div class="uk-panel uk-panel-box">
            <div class="uk-grid">
                <div class="uk-width-1-1">
                    <h2>Elternzufriedenheitsbefragung {{$result->group_name}}</h2>
                </div>
                @foreach($result->data as $section)
                    <br/><br/>
                    <div class="uk-width-1-1 uk-margin-large-top" style="page-break-before: always;">
                        <h3><strong>{{$section['name']}}</strong></h3>
                    </div>
                    <br/>
                    @foreach($section['questiongroups'] as $questiongroup)
                        <div class="uk-width-1-1 uk-margin-top">
                            <div class="uk-grid uk-grid-divider">
                                <div class="uk-width-1-1">
                                    <div class="uk-grid" style="page-break-inside: avoid;">
                                        <div class="uk-width-1-1">
                                            @if($questiongroup['type'] == 1)
                                                <strong>{{$questiongroup['name']}}</strong><br/>
                                                @if(isset($questiongroup['answers']))
                                                    @foreach($questiongroup['answers'] as $answer)
                                                        @if($answer != "")
                                                            <p style="background-color: rgba(0,0,0,0.1);padding: 10px;">{{$answer}}</p>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @elseif($questiongroup['type'] == 2)
                                                <table border="1" class="uk-table uk-float-right">
                                                    <thead>
                                                    <tr>
                                                        <th>{{$questiongroup['name']}}</th>
                                                        <th style="width: 90px;">Antworten</th>
                                                        <th style="width: 60px;">Quote</th>
                                                    </tr>
                                                    <tbody>
                                                    @foreach($questiongroup['answers'] as $answer)
                                                        <tr>
                                                            <td>{{$answer['vote']}}</td>
                                                            <td>{{$answer['absolut']}}</td>
                                                            <td>{{$answer['percent']}}%</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                    </thead>
                                                </table>
                                            @elseif($questiongroup['type'] == 3)
                                                <table border="1" class="uk-table uk-float-right">
                                                    <thead>
                                                    <tr>
                                                        <th>{{$questiongroup['name']}}</th>
                                                        <th style="width: 90px;">sehr gut/gut</th>
                                                        <th style="width: 90px;">befr./ausrei.</th>
                                                        <th style="width: 90px;">ungenügend</th>
                                                    </tr>
                                                    <tbody>
                                                    @foreach($questiongroup['answers'] as $answer)
                                                        <tr>
                                                            <td>{{$answer['name']}}</td>
                                                            <td>{{$answer['votes'][1]['percent']+$answer['votes'][2]['percent']}}%</td>
                                                            <td>{{$answer['votes'][3]['percent']+$answer['votes'][4]['percent']}}%</td>
                                                            <td>{{$answer['votes'][5]['percent']}}%</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                    </thead>
                                                </table>
                                            @elseif($questiongroup['type'] == 4)
                                                <table border="1" class="uk-table uk-float-right">
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
                                                            @foreach($answer['votes'] as $thing=>$vote)
                                                                <td>{{$vote['absolut']}}</td>
                                                                <td>{{$vote['percent']}}%</td>
                                                            @endforeach
                                                        </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td colspan="20">NPS={{$questiongroup['mps']}}%</td>
                                                    </tr>
                                                    </tbody>
                                                    </thead>
                                                </table>

                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br/>
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
@stop