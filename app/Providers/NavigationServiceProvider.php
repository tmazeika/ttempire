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
        view()->composer(['home', 'shop.*', 'contact'], function(View $view) {
            $view->with('navItems', [
                new NavigationItem(trans('page.title.shop.index'), url('/shop'), $view->name() === 'shop.index'),
                new NavigationItem(trans('page.title.blog'), '/blog', false),
                new NavigationItem(trans('page.title.contact'), url('/contact'), $view->name() === 'contact'),
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
