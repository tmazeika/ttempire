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
                new NavigationItem(trans('page.title.shop'),    url('/shop')),
                new NavigationItem(trans('page.title.blog'),    '/blog'),
                new NavigationItem(trans('page.title.contact'), url('/contact')),
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
