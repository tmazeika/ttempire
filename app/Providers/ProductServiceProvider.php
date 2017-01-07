<?php

namespace PingPongShop\Providers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\ServiceProvider;
use PingPongShop\Product;
use PingPongShop\ProductDiscount;

class ProductServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('shop.*', function(View $view) {
            $products = [
                new Product(trans('products.1star'), asset('img/product_1star.jpg'), 195, 500),

                new Product(trans('products.3star'), asset('img/product_3star.jpg'), 294, 300,
                    new ProductDiscount(3, 60)),
            ];

            foreach ($products as $i => $product) {
                $product->setId($i);
            }

            $view->with('products', $products);
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
