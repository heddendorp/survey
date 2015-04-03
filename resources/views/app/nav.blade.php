
        <div class="ui secondary pointing menu">
            <a class="@if(str_contains(Route::getCurrentRoute()->getActionName(),'CustomerController')) active @endif item" style="margin-left: 4em;">
                <i class="dashboard icon"></i> Übersicht
            </a>
            <a class="item">
                <i class="users icon"></i> Benutzer
            </a>
            <a class="item">
                <i class="archive icon"></i> Teilnehmer
            </a>
            <a class="item">
                <i class="book icon"></i> Fragebögen
            </a>
            <a class="item">
                <i class="newspaper icon"></i> Umfragen
            </a>
            <div class="right menu">
                <a class="item" style="margin-right: 4em;">
                    <i class="sign out icon"></i> Abmelden
                </a>
            </div>
        </div>
