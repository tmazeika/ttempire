<?php

namespace TTEmpire\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class LoadShoppingCart
{
    public function handle(Request $request, Closure $next)
    {
        View::share('cart', resolve('TTEmpire\ShoppingCart'));

        return $next($request);
    }
}
