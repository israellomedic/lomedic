<?php

namespace abisa\Providers;

use Illuminate\Support\Facades\Route;
use File;
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
    protected $namespace = 'abisa\Http\Controllers';

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
        $this->mapRouteByDirectory();
        //$this->mapWebRoutes();
        //$this->mapApiRoutes();
    }
    /**
    * Definicion de Rutas en el directorio baseSistema/route,
    *
    * Solo se aceptaran los archivos con terminacion Route.php (*Route.php)
    *
    * Ejemplo de archivo Route: AdministracionRoute.php
    */
    protected function mapRouteByDirectory()
    {
        Route::group(['namespace' => $this->namespace], function ($router) {
            foreach(File::allFiles(base_path().'/routes') as $route) {
                $pathName = $route->getPathname();
                if(preg_match("/^.*Route.php$/", $pathName))
                    require $route->getPathname();
            }
        });
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
            'namespace'  => $this->namespace,
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
            'middleware' => 'api',
            'namespace' => $this->namespace,
            'prefix' => 'api',
        ], function ($router) {
            require base_path('routes/api.php');
        });
    }
}
