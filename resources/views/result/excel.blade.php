@extends('partials.excel')
@section('head-style')
    style="background: url({{asset('img/pattern.png')}});"
@stop
@section('content')
    <div class="uk-container uk-container-center uk-margin-large-top">
        <div class="uk-panel uk-panel-box">
            <div class="uk-grid">
                <div class="uk-width-1-2">
                    <h3>Elternzufriedenheitsbefragung {{$result->group_name}}</h3>
                </div>
                <div class="uk-width-1-2">
                    <h3>Bemerkungen/Maßnahmen Joki</h3>
                </div>
                @foreach($result->data as $section)
                    <div class="uk-width-1-1 uk-margin-large-top" style="page-break-before: always;">
                        <h4>{{$section['name']}}</h4>
                        <hr class="uk-grid-divider"/>
                    </div>
                    @foreach($section['questiongroups'] as $questiongroup)
                        <div class="uk-width-1-1 uk-margin-top">
                            <div class="uk-grid uk-grid-divider">
                                <div class="uk-width-1-1">
                                    <div class="uk-grid" style="page-break-inside: avoid;">
                                        <div class="uk-width-1-1">
                                            {{$questiongroup['name']}}
                                        </div>
                                        <div class="uk-width-1-1">
                                            @if($questiongroup['type'] == 1)
                                                @if(isset($questiongroup['answers']))
                                                    @foreach($questiongroup['answers'] as $answer)
                                                    <div style="border: rgba(0, 0, 0, 0.5); border-style: groove;">
                                                        <span onclick="$(this).parent('div').remove();" class="uk-close"></span>
                                                        {{$answer}}
                                                    </div><br/>
                                                    @endforeach
                                                @else
                                                    <div style="border: rgba(0, 0, 0, 0.5); border-style: groove;">
                                                        <span onclick="$(this).parent('div').remove();" class="uk-close"></span>
                                                        Es wurden noch keine Antworten abgegeben.
                                                    </div>
                                                @endif
                                            @elseif($questiongroup['type'] == 2)
                                                <table border="1" class="uk-table uk-float-right">
                                                    <thead>
                                                    <tr>
                                                        <th>Option</th>
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
                                                        <th>Option</th>
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
                                                            @foreach($answer['votes'] as $vote)
                                                                <td>{{$vote['absolut']}}</td>
                                                                <td>{{$vote['percent']}}%</td>
                                                            @endforeach
                                                        </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td colspan="20">MPS={{$questiongroup['mps']}}%</td>
                                                    </tr>
                                                    </tbody>
                                                    </thead>
                                                </table>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="uk-width-1-1 uk-form">
                                    <br/>
                                    <span onclick="$(this).parent('div').remove();" class="uk-close uk-float-right"></span>
                                    <textarea style="width: 100%;" rows="3" placeholder="Anmerkungen, falls nicht verwendet mit dem Kreuz entfernen"></textarea>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
@stop