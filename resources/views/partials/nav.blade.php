<nav class="uk-navbar uk-margin-large-bottom">
    <a style="background-color: #FF5722; color: white" href="{{route('customer.show',$customer)}}" class="uk-navbar-brand">Survey-X</a>
    <ul class="uk-navbar-nav">
        @if(Auth::user()->role['admin'])
        <li><a href="{{route('customer.user.index',$customer)}}">Benutzer</a></li>
        @endif
        @if(Auth::user()->role['admin'] || Auth::user()->role['questionnaire.show'])
        <li><a href="{{route('customer.questionnaire.index',$customer)}}">Fragebogen</a></li>
        @endif
        @if(Auth::user()->role['admin'] || Auth::user()->role['participant.show'])
        <li><a href="{{route('customer.iteration.index',$customer)}}">Teilnehmer</a></li>
        @endif
        @if(Auth::user()->role['admin'] || Auth::user()->role['survey.show'])
        <li><a href="{{route('customer.survey.index',$customer)}}">Umfragen</a></li>
        @endif
    </ul>
    <div class="uk-navbar-content uk-navbar-flip"><a href="{{action('WelcomeController@logout')}}">Abmelden</a></div>
    <div class="uk-navbar-content uk-navbar-center">
        <span>{{$customer->name}}/{{Auth::user()->username}}</span>
    </div>
</nav>