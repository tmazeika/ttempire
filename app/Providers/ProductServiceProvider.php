<?php

namespace PingPongShop\Providers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\ServiceProvider;
use PingPongShop\Contracts\ProductRepository;
use PingPongShop\Repositories\ProductRepositoryImpl;

class ProductServiceProvider extends ServiceProvider
{
    public function boot(ProductRepository $productRepo)
    {
        view()->composer('shop', function(View $view) use ($productRepo) {
            $products = $productRepo->getProducts();

            $view->with('products', $products);
        });
    }

    public function register()
    {
        $this->app->bind(ProductRepository::class, ProductRepositoryImpl::class);
    }
}
