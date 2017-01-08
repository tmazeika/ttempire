<?php

namespace PingPongShop\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class SetCheckoutVisibility
{
    public function handle(Request $request, Closure $next)
    {
        View::share(['cartSize' => resolve('PingPongShop\ShoppingCart')->getSize()]);

        return $next($request);
    }
}
