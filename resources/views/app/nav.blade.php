
<?php
$action = str_replace('Survey\Http\Controllers\\', '', Route::getCurrentRoute()->getActionName());
?>
<div class="ui secondary pointing menu">
    <a href="{{route('customer.show', $customer)}}" class="@if(str_contains($action,'CustomerController')) active @endif item" style="margin-left: 4em;">
        <i class="dashboard icon"></i> {{ trans('if.app.survey') }}
    </a>
    <a href="{{route('customer.user.index', $customer)}}" class="@if(str_contains($action,'User')) active @endif item">
        <i class="users icon"></i> {{ trans('if.app.user') }}
    </a>
    <a href="{{route('customer.set.index', $customer)}}" class="@if(str_contains($action,'Set')) active @endif item">
        <i class="archive icon"></i> {{ trans('if.app.partic') }}
    </a>
    <a href="{{route('customer.questionnaire.index', $customer)}}" class="@if(str_contains($action,'Questionnaire')) active @endif item">
        <i class="book icon"></i> {{ trans('if.app.ques') }}
    </a>
    <a href="{{route('customer.survey.index', $customer)}}" class="@if(str_contains($action,'Survey')) active @endif item">
        <i class="newspaper icon"></i> {{ trans('if.app.polls') }}
    </a>
    <div class="right menu">
        <a class="item" style="margin-right: 4em;" href="{{url('logout')}}">
            <i class="sign out icon"></i> {{ trans('if.app.logout') }}
        </a>
    </div>
</div>
@if(str_contains($action, 'Set'))
<div class="ui grid">
    <div class="two wide column"></div>
    <div class="twelve wide column">
        <div class="ui stacked segment">
            <div class="ui breadcrumb">
                <a class="section" href="{{route('customer.set.index', $customer)}}">{{ trans('if.app.partic') }}</a>
                @if(str_contains($action,'Facility'))
                    <i class="right chevron icon divider"></i>
                    <a class="section" href="{{route('customer.set.facility.index', [$customer, $set])}}">{{$set->name}}</a>
                @endif
                @if(str_contains($action,'Group'))
                    <i class="right chevron icon divider"></i>
                    <a class="section" href="{{route('customer.set.facility.group.index', [$customer, $set, $facility])}}">{{$facility->name}}</a>
                @endif
            </div>
        </div>
    </div>
</div>
@endif
