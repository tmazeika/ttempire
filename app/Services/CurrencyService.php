<?php

namespace TTEmpire\Services;

use TTEmpire\Contracts\CurrencyServiceContract;
use TTEmpire\SubQuantity;

class CurrencyService implements CurrencyServiceContract
{
    private const CUR_EUR = 'eur', CUR_USD = 'usd';

    private $currency;

    public function getPrice(SubQuantity $subQuantity): int
    {
        return $this->getCurrency() === self::CUR_EUR
            ? $subQuantity->eur_price
            : $subQuantity->usd_price;
    }

    public function formatPrice(float $price, int $decimals = 0): string
    {
        return ($this->getCurrency() === self::CUR_EUR ? '&euro;' : '$')
            . number_format($price / 100, $decimals);
    }

    public function getAndFormatPrice(SubQuantity $subQuantity, int $decimals = 0, int $count = 1): string
    {
        return $this->formatPrice($this->getPrice($subQuantity) * $count, $decimals);
    }

    public function getCurrency(): string
    {
        return $this->currency
            ? $this->currency
            : ($this->currency = session('currency', self::CUR_EUR));
    }

    public function setCurrency(string $currency): void
    {
        if ($currency === self::CUR_USD || $currency === self::CUR_EUR) {
            $this->currency = $currency;
            session(compact('currency'));
        }
    }

    public function isEur(): bool
    {
        return $this->getCurrency() === self::CUR_EUR;
    }
}
