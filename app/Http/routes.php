<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::resource('customer','CustomerController');

Route::resource('customer.user','CustomerUserController');

Route::resource('customer.questionnaire','CustomerQuestionnaireController');

Route::resource('customer.questionnaire.section','CustomerQuestionnaireSectionController');

Route::resource('customer.questionnaire.section.questiongroup','CustomerQuestionnaireSectionQuestiongroupController');

Route::resource('customer.questionnaire.section.questiongroup.question','CustomerQuestionnaireSectionQuestiongroupQuestionController');

Route::resource('customer.iteration','CustomerIterationController');

Route::resource('customer.iteration.facility','CustomerIterationFacilityController');

Route::resource('customer.iteration.facility.group','CustomerIterationFacilityGroupController');

Route::resource('customer.iteration.facility.group.child','CustomerIterationFacilityGroupChildController');

Route::resource('mail','MailController');

