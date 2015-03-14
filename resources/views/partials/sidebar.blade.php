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
@if(isset($questiongroups) || (empty($sections) && isset($section)))
    <li><a href="{{route('customer.questionnaire.section.index', [$customer, $questionnaire])}}"><i class="uk-icon-tags"></i>&nbsp;Alle Sektionen</a></li>
@endif
@if(isset($questiongroups))
    <li><a href="{{route('customer.questionnaire.section.questiongroup.create', [$customer, $questionnaire, $section])}}"><i class="uk-icon-file uk-text-success"></i>&nbsp;Neue Frage</a></li>
@endif
@if(empty($questiongroups) && isset($questiongroup))
    <li><a href="{{route('customer.questionnaire.section.questiongroup.index', [$customer, $questionnaire, $section])}}"><i class="uk-icon-sitemap"></i>&nbsp;Alle Fragen</a></li>
@endif


