<?php

namespace TTEmpire\Providers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\ServiceProvider;
use TTEmpire\Contracts\NavigationRepository;
use TTEmpire\NavigationItem;
use TTEmpire\Repositories\NavigationRepositoryImpl;
use TTEmpire\ShoppingCart;

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
