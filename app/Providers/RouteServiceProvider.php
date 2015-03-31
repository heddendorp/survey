<?php namespace Survey\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider {

	/**
	 * This namespace is applied to the controller routes in your routes file.
	 *
	 * In addition, it is set as the URL generator's root namespace.
	 *
	 * @var string
	 */
	protected $namespace = 'Survey\Http\Controllers';

	/**
	 * Define your route model bindings, pattern filters, etc.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	public function boot(Router $router)
	{
		parent::boot($router);

        $router->model('customer', 'Survey\Customer');
        $router->model('user', 'Survey\User');
        $router->model('questionnaire', 'Survey\Questionnaire');
        $router->model('section', 'Survey\Section');
        $router->model('questiongroup', 'Survey\Questiongroup');
        $router->model('iteration', 'Survey\Iteration');
        $router->model('facility', 'Survey\Facility');
        $router->model('group', 'Survey\Group');
        $router->model('child', 'Survey\Child');
        $router->model('survey', 'Survey\Survey');
        $router->model('token', 'Survey\Token');
        $router->model('result', 'Survey\Result');
	}

	/**
	 * Define the routes for the application.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	public function map(Router $router)
	{
		$router->group(['namespace' => $this->namespace], function($router)
		{
			/** @noinspection PhpIncludeInspection */
			require app_path('Http/routes.php');
		});
	}

}
