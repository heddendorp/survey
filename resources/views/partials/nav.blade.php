<nav class="uk-navbar uk-margin-large-bottom">
    <a style="background-color: #FF5722; color: white" href="{{route('customer.show',$customer)}}" class="uk-navbar-brand">Survey-X</a>
    <ul class="uk-navbar-nav">
        <li><a href="{{route('customer.user.index',$customer)}}">Benutzer</a></li>
        <li><a href="{{route('customer.questionnaire.index',$customer)}}">Fragebogen</a></li>
    </ul>
    <div class="uk-navbar-content uk-navbar-flip"><a href="{{action('WelcomeController@logout')}}">Abmelden</a></div>
    <div class="uk-navbar-content uk-navbar-center">
        <span>{{$customer->name}}/{{Auth::user()->username}}</span>
    </div>
</nav>