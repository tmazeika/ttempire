<?php

namespace PingPongShop\Providers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\ServiceProvider;
use PingPongShop\Contracts\ProductRepository;
use PingPongShop\CurrencyConverter;
use PingPongShop\Repositories\ProductRepositoryImpl;

class ProductServiceProvider extends ServiceProvider
{
    public function boot(ProductRepository $productRepo)
    {
        view()->composer('shop.*', function(View $view) use ($productRepo) {
            $products = $productRepo->getProducts();

            $view->with('products', $products);
        });

        view()->composer('*', function(View $view) {
            $view->with('shippingCost', CurrencyConverter::convert('USD', trans('currency.code'), 6, 2));
        });
    }

    public function register()
    {
        $this->app->bind(ProductRepository::class, ProductRepositoryImpl::class);
    }
}
