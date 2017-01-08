<?php

namespace PingPongShop\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class LoadShoppingCart
{
    public function handle(Request $request, Closure $next)
    {
        View::share('cart', resolve('PingPongShop\ShoppingCart'));

        return $next($request);
    }
}
