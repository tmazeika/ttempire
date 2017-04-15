<?php

namespace TTEmpire\Contracts;

use TTEmpire\SubQuantity;

interface CurrencyServiceContract
{
    public function getPrice(SubQuantity $subQuantity): int;

    public function formatPrice(float $price, int $decimals = 0): string;

    public function getAndFormatPrice(SubQuantity $subQuantity, int $decimals = 0, int $count = 1): string;

    public function getCurrency(): string;

    public function setCurrency(string $currency): void;

    public function isEur(): bool;
}
