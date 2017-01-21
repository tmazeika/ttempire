<?php

namespace PingPongShop\Providers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\ServiceProvider;
use PingPongShop\Contracts\NavigationRepository;
use PingPongShop\NavigationItem;
use PingPongShop\Repositories\NavigationRepositoryImpl;
use PingPongShop\ShoppingCart;

class NavigationServiceProvider extends ServiceProvider
{
    public function boot(NavigationRepository $navigationRepo)
    {
        view()->composer(['home', 'shop.*', 'contact'], function(View $view) use ($navigationRepo) {
            $view->with('navItems', $navigationRepo->getItems($view->name()));
        });
    }

    public function register()
    {
        $this->app->bind(NavigationRepository::class, NavigationRepositoryImpl::class);
    }
}
