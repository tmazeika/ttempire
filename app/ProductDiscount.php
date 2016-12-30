<?php

namespace PingPongShop;

class ProductDiscount
{
    public function __construct(int $every, float $deduction)
    {
        $this->every = $every;
        $this->deduction = $deduction;
    }

    public function getEvery() : int
    {
        return $this->every;
    }

    public function getDeduction() : float
    {
        return $this->deduction;
    }
}
