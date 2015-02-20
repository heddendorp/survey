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

Route::get('login', 'WelcomeController@login');

Route::post('login', 'WelcomeController@authenticate');

Route::get('logout', 'WelcomeController@logout');

Route::resource('customer', 'CustomerController');

Route::resource('customer.user', 'CustomerUserController', ['except'=>'show']);

Route::resource('customer.questionnaire', 'CustomerQuestionnaireController', ['except'=>'show']);

Route::resource('customer.questionnaire.section', 'CustomerQuestionnaireSectionController', ['except'=>'show']);

Route::resource('customer.questionnaire.section.questiongroup', 'CustomerQuestionnaireSectionQuestiongroupController', ['except'=>'show']);

Route::post('customer/{customer}/questionnaire/{questionnaire}/section/{section}/questiongroup/order',['as' => 'customer.questionnaire.section.questiongroup.order', 'uses' => 'CustomerQuestionnaireSectionQuestiongroupController@order']);

Route::resource('customer.questionnaire.section.questiongroup.question', 'CustomerQuestionnaireSectionQuestiongroupQuestionController', ['only'=>['index', 'destroy']]);

Route::resource('customer.iteration', 'CustomerIterationController');

Route::resource('customer.iteration.facility', 'CustomerIterationFacilityController');

Route::resource('customer.iteration.facility.group', 'CustomerIterationFacilityGroupController');

Route::resource('customer.iteration.facility.group.child', 'CustomerIterationFacilityGroupChildController');

Route::resource('mail', 'MailController');

