<?php

namespace App\ZipCodes\Search\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class AppServiceProvider
 * @package App\ZipCodes\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\ZipCodes\Search\Models\Repositories\ZipCodeRepositoryInterface',
            'App\ZipCodes\Search\Models\Repositories\ZipCodeRepository'
        );
    }
}
