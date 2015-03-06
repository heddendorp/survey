<?php namespace Survey\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel {

	/**
	 * The application's global HTTP middleware stack.
	 *
	 * @var array
	 */
	protected $middleware = [
		'Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode',
		'Illuminate\Cookie\Middleware\EncryptCookies',
		'Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse',
		'Illuminate\Session\Middleware\StartSession',
		'Illuminate\View\Middleware\ShareErrorsFromSession',
		'Survey\Http\Middleware\VerifyCsrfToken',
	];

	/**
	 * The application's route middleware.
	 *
	 * @var array
	 */
	protected $routeMiddleware = [
		'auth' => 'Survey\Http\Middleware\Authenticate',
		'auth.basic' => 'Illuminate\Auth\Middleware\AuthenticateWithBasicAuth',
		'guest' => 'Survey\Http\Middleware\RedirectIfAuthenticated',
        'customer' => 'Survey\Http\Middleware\CustomerCheck',
        'customerplus' => 'Survey\Http\Middleware\CustomerPlusCheck',
        'questionnairePerms' => 'Survey\Http\Middleware\QuestionnairePermissions',
        'participantPerms' => 'Survey\Http\Middleware\ParticipantPermissions',
        'surveyPerms' => 'Survey\Http\Middleware\SurveyPermissions',
        'resultPerms' => 'Survey\Http\Middleware\ResultPermissions'
	];

}
