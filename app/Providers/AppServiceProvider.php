<?php

namespace TTEmpire\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('active', function (string $page) {
            return '<?php if (isset($active) && $active === "' . addslashes($page) . '") echo "active"; ?>';
        });

        Blade::directive('activeCurrency', function (string $currency) {
            return '<?php if ($currencyService->getCurrency() === "' . addslashes($currency) . '") echo "active"; ?>';
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'TTEmpire\Contracts\CartServiceContract',
            'TTEmpire\Services\CartService'
        );

        $this->app->bind(
            'TTEmpire\Contracts\CurrencyServiceContract',
            'TTEmpire\Services\CurrencyService'
        );
    }
}
