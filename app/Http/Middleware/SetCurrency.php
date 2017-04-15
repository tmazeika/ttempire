<?php

namespace TTEmpire\Http\Middleware;

use Closure;
use TTEmpire\Contracts\CurrencyServiceContract;

class SetCurrency
{
    private $currencyService;

    public function __construct(CurrencyServiceContract $currencyService)
    {
        $this->currencyService = $currencyService;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($currency = $request->input('currency')) {
            $this->currencyService->setCurrency($currency);
        }

        return $next($request);
    }
}
