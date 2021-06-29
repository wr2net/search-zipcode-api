<?php

namespace App\ZipCodes\Common\Traits;

use Illuminate\Support\Facades\Route;

trait RouteServiceProviderTrait
{
    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();
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
        $path = str_replace('\\', DIRECTORY_SEPARATOR, app_path($this->routePath.'\api.php'));
        Route::prefix('api')
            ->as('api.')
            ->middleware(['api'])
            ->namespace($this->namespace.'\Api')
            ->group($path);
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
        $path = str_replace('\\', DIRECTORY_SEPARATOR, app_path($this->routePath.'\web.php'));
        Route::middleware(['web', 'auth'])
            ->namespace($this->namespace.'\Web')
            ->group($path);
    }
}
