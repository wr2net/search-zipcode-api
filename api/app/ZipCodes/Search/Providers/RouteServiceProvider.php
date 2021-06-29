<?php

namespace App\ZipCodes\Search\Providers;

use App\ZipCodes\Common\Traits\RouteServiceProviderTrait;
use App\ZipCodes\Search\Models\ZipCode;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

/**
 * Class RouteServiceProvider
 * @package App\ZipCodes\Providers
 */
class RouteServiceProvider extends ServiceProvider
{
    use RouteServiceProviderTrait;

    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\ZipCodes\Search\Controllers';

    /**
     * @var string
     */
    protected $routePath = 'ZipCodes\Search\Routes';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        Route::bind('zipCode', function ($value) {
            return ZipCode::withTrashed()->find($value);
        });

        parent::boot();
    }
}
