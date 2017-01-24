<?php

namespace TTEmpire;

class ProductQuantity
{
    public function __construct(int $qty, float $ppu)
    {
        $this->qty = $qty;
        $this->price = $qty * $ppu;
    }

    public function getQty() : int
    {
        return $this->qty;
    }

    public function getPricePerUnit() : float
    {
        return CurrencyConverter::convert('EUR', trans('currency.code'), $this->price / $this->qty, 2);
    }

    public function getPricePerBox() : float
    {
        return CurrencyConverter::convert('EUR', trans('currency.code'), $this->price);
    }
}
