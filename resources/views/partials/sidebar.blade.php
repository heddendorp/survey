@if(isset($customer))
    <li><a href="{{route('customer.show', $customer)}}"><i class="uk-icon-home"></i>&nbsp;Übersicht</a></li>
@endif
@if(isset($questionnaires))
    <li><a href="{{route('customer.questionnaire.create', $customer)}}"><i class="uk-icon-file uk-text-success"></i>&nbsp;Neuer Fragebogen</a></li>
@endif
@if(isset($sections) || (empty($questionnaires) && isset($questionnaire)))
    <li><a href="{{route('customer.questionnaire.index', $customer)}}"><i class="uk-icon-server"></i>&nbsp;Alle Fragebögen</a></li>
@endif
@if(isset($sections))
    <li><a href="{{route('customer.questionnaire.section.create', [$customer, $questionnaire])}}"><i class="uk-icon-file uk-text-success"></i>&nbsp;Neue Sektion</a></li>
@endif
@if(isset($questiongroups) && isset($questionnaire) || (empty($sections) && isset($section) && isset($questionnaire)))
    <li><a href="{{route('customer.questionnaire.section.index', [$customer, $questionnaire])}}"><i class="uk-icon-tags"></i>&nbsp;Alle Sektionen</a></li>
@endif
@if(isset($questiongroups))
    <li><a href="{{route('customer.questionnaire.section.questiongroup.create', [$customer, $questionnaire, $section])}}"><i class="uk-icon-file uk-text-success"></i>&nbsp;Neue Frage</a></li>
@endif
@if(empty($questiongroups) && isset($questiongroup) && isset($questionnaire))
    <li><a href="{{route('customer.questionnaire.section.questiongroup.index', [$customer, $questionnaire, $section])}}"><i class="uk-icon-sitemap"></i>&nbsp;Alle Fragen</a></li>
@endif
@if(isset($iterations))
    <li><a href="{{route('customer.iteration.create', $customer)}}"><i class="uk-icon-file uk-text-success"></i>&nbsp;Neue Iteration</a></li>
@endif
@if(isset($facilities) || (empty($iterations) && isset($iteration)))
    <li><a href="{{route('customer.iteration.index', $customer)}}"><i class="uk-icon-server"></i>&nbsp;Alle Iterationen</a></li>
@endif
@if(isset($facilities))
    <li><a href="{{route('customer.iteration.facility.create', [$customer, $iteration])}}"><i class="uk-icon-file uk-text-success"></i>&nbsp;Neuer Standort</a></li>
@endif
@if(isset($groups) || (empty($facilities) && isset($facility)))
    <li><a href="{{route('customer.iteration.facility.index', [$customer, $iteration])}}"><i class="uk-icon-tags"></i>&nbsp;Alle Standorte</a></li>
@endif
@if(isset($groups))
    <li><a href="{{route('customer.iteration.facility.group.create', [$customer, $iteration, $facility])}}"><i class="uk-icon-file uk-text-success"></i>&nbsp;Neue Gruppe</a></li>
@endif
@if(isset($children) && isset($facilities)  || (empty($groups) && isset($group) && isset($facilities)))
    <li><a href="{{route('customer.iteration.facility.group.index', [$customer, $iteration, $facility])}}"><i class="uk-icon-users"></i>&nbsp;Alle Gruppen</a></li>
@endif
@if(isset($children))
    <li><a href="{{route('customer.iteration.facility.group.index', [$customer, $iteration, $facility])}}"><i class="uk-icon-users"></i>&nbsp;Alle Gruppen</a></li>
    <li><a href="{{route('customer.iteration.facility.group.child.create', [$customer, $iteration, $facility, $group])}}"><i class="uk-icon-user-plus uk-text-success"></i>&nbsp;Kind Hinzufügen</a></li>
    <li><a href="{{route('customer.iteration.facility.group.child.multi', [$customer, $iteration, $facility, $group])}}"><i class="uk-icon-database uk-text-success"></i>&nbsp;Mehrere Kinder hinzufügen</a></li>
@endif
@if(empty($children) && isset($child))
    <li><a href="{{route('customer.iteration.facility.group.child.index', [$customer, $iteration, $facility, $group])}}"><i class="uk-icon-child"></i>&nbsp;Alle Kinder</a></li>
@endif
@if(isset($users))
    <li><a href="{{route('customer.user.create', [$customer])}}"><i class="uk-icon-user-plus uk-text-success"></i>&nbsp;Benutzer Hinzufügen</a></li>
@endif
@if(isset($surveys))
    <li><a href="{{route('customer.survey.create', [$customer])}}"><i class="uk-icon-file uk-text-success"></i>&nbsp;Umfrage beginnen</a></li>
@endif
@if(isset($results))
    <li><a href="{{route('customer.survey.index', [$customer])}}"><i class="uk-icon-server"></i>&nbsp;Alle Umfragen</a></li>
@endif