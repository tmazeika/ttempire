<?php

namespace PingPongShop\Providers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\ServiceProvider;
use PingPongShop\NavigationItem;

class NavigationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function(View $view) {
            $view->with('navItems', [
                new NavigationItem('Shop', url('/shop')),
                new NavigationItem('Blog', '/blog'),
                new NavigationItem('Contact', url('/contact')),
            ]);
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
