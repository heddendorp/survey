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

//Papertrail
$monolog = Log::getMonolog();
$syslog = new \Monolog\Handler\SyslogHandler('papertrail');
$formatter = new \Monolog\Formatter\LineFormatter('%channel%.%level_name%: %message% %extra%');
$syslog->setFormatter($formatter);

$monolog->pushHandler($syslog);

//routes

Route::get('/', 'WelcomeController@index');

Route::get('data', function () {
    return response()->download(storage_path().'/database.sqlite');
});

Route::get('env', function () {
    return app()->environment();
});

Route::get('login', 'WelcomeController@login');

Route::post('login', 'WelcomeController@authenticate');

Route::get('logout', 'WelcomeController@logout');

Route::resource('customer', 'CustomerController');

Route::resource('customer.user', 'CustomerUserController', ['except' => 'show']);

Route::resource('customer.survey', 'CustomerSurveyController');

Route::get('customer/{customer}/survey/{survey}/send-mails/{type}', ['as' => 'customer.survey.sendWelcome', 'uses' => 'CustomerSurveyController@sendMails']);

Route::get('customer/{customer}/survey/{survey}/analyze/{result}', ['as' => 'customer.survey.analyze', 'uses' => 'CustomerSurveyController@analyze']);

Route::get('customer/{customer}/survey/{survey}/result/standard/{result}', ['as' => 'customer.survey.result.standard', 'uses' => 'CustomerSurveyResultController@standard']);

Route::get('customer/{customer}/survey/{survey}/result/excel/{result}', ['as' => 'customer.survey.result.table', 'uses' => 'CustomerSurveyResultController@excel']);

Route::get('customer/{customer}/survey/{survey}/result/copy/{result}', ['as' => 'customer.survey.result.copy', 'uses' => 'CustomerSurveyResultController@copy']);

Route::get('customer/{customer}/survey/{survey}/result/facility/{id}/{view}', ['as' => 'customer.survey.result.facility', 'uses' => 'CustomerSurveyResultController@facility']);

Route::resource('customer.questionnaire', 'CustomerQuestionnaireController', ['except' => 'show']);

Route::get('customer/{customer}/questionnaire/{questionnaire}/duplicate', ['as' => 'customer.questionnaire.duplicate', 'uses' => 'CustomerQuestionnaireController@duplicate']);

Route::resource('customer.questionnaire.section', 'CustomerQuestionnaireSectionController', ['except' => 'show']);

Route::resource('customer.questionnaire.section.questiongroup', 'CustomerQuestionnaireSectionQuestiongroupController', ['except' => 'show']);

Route::post('customer/{customer}/questionnaire/{questionnaire}/section/{section}/questiongroup/order', ['as' => 'customer.questionnaire.section.questiongroup.order', 'uses' => 'CustomerQuestionnaireSectionQuestiongroupController@order']);

//Route::resource('customer.questionnaire.section.questiongroup.question', 'CustomerQuestionnaireSectionQuestiongroupQuestionController', ['only'=>['index', 'destroy']]);

Route::resource('customer.iteration', 'CustomerIterationController', ['except' => 'show']);

Route::resource('customer.iteration.facility', 'CustomerIterationFacilityController', ['except' => 'show']);

Route::resource('customer.iteration.facility.group', 'CustomerIterationFacilityGroupController', ['except' => 'show']);

Route::resource('customer.iteration.facility.group.child', 'CustomerIterationFacilityGroupChildController', ['except' => 'show']);

Route::get('customer/{customer}/iteration/{iteration}/facility/{facility}/group/{group}/multi', ['as' => 'customer.iteration.facility.group.child.multi', 'uses' => 'CustomerIterationFacilityGroupChildController@multi']);

Route::post('customer/{customer}/iteration/{iteration}/facility/{facility}/group/{group}/storemany', ['as' => 'customer.iteration.facility.group.child.storemany', 'uses' => 'CustomerIterationFacilityGroupChildController@storemany']);

Route::resource('mail', 'MailController');

Route::get('/survey/{survey}/token/{key}', ['as' => 'survey.token.key', 'uses' => 'TokenController@key']);

Route::post('/survey/{survey}/token/{token}', ['as' => 'survey.token.answer', 'uses' => 'TokenController@answer']);
