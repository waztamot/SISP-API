<?php

namespace SISP\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'SISP\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::group([
            'middleware' => 'web',
            'namespace' => $this->namespace,
        ], function ($router) {
            require base_path('routes/web.php');
        });
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::group([
            'middleware' => ['api','cors'], //  auth:api (Segun Guia de https://github.com/tymondesigns/jwt-auth/issues/860)
            // 'namespace' => $this->namespace,
            'namespace' => 'Modules',
            'prefix' => 'api',
        ], function ($router) {

            // require base_path('routes/api.php');

            $routesModules = [
                base_path('Modules/Security/Http/routes.php'),
                base_path('Modules/Product/Http/routes.php'),
                // base_path('Modules/**/Routes/routes.php'),
            ];

            for ($i=0; $i < count($routesModules); $i++) { 
                if (file_exists($routesModules[$i])) {
                    require $routesModules[$i];
                }
            }

        });
    }
}
