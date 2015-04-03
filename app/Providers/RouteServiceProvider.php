<?php

namespace Survey\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
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
     * @param \Illuminate\Routing\Router $router
     */
    public function boot(Router $router)
    {
        parent::boot($router);

        $router->model('customer', 'Survey\Models\Customer');
        $router->model('user', 'Survey\Models\User');
        $router->model('questionnaire', 'Survey\Models\Questionnaire');
        $router->model('section', 'Survey\Models\Section');
        $router->model('batch', 'Survey\Models\Batch');
        $router->model('set', 'Survey\Models\Set');
        $router->model('facility', 'Survey\Models\Facility');
        $router->model('group', 'Survey\Models\Group');
        $router->model('child', 'Survey\Models\Child');
        $router->model('survey', 'Survey\Models\Survey');
        $router->model('token', 'Survey\Models\Token');
        $router->model('result', 'Survey\Models\Result');
    }

    /**
     * Define the routes for the application.
     *
     * @param \Illuminate\Routing\Router $router
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function ($router) {
            /** @noinspection PhpIncludeInspection */
            require app_path('Http/routes.php');
        });
    }
}
