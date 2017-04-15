<?php

namespace TTEmpire\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function (View $view) {
            $view->with('cart', app()->make('TTEmpire\Contracts\CartServiceContract'));
        });

        view()->composer(['shop.*', 'partials.header'], function (View $view) {
            $view->with('currencyService', app()->make('TTEmpire\Contracts\CurrencyServiceContract'));
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
