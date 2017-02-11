<?php

namespace TTEmpire;

class ProductQuantity
{
    public function __construct(float $pricePerBall, int $ballsPerBox)
    {
        $this->pricePerBall = $pricePerBall;
        $this->ballsPerBox = $ballsPerBox;
    }

    public function getPricePerBall(): float
    {
        return $this->pricePerBall;
    }

    public function getPricePerBox(): float
    {
        return $this->pricePerBall * $this->ballsPerBox;
    }

    public function getBallsPerBox(): int
    {
        return $this->ballsPerBox;
    }
}
