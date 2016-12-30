<?php

namespace PingPongShop;

class Product
{
    public function __construct(string $title, string $img, float $price, int $qtyInc, ProductDiscount ...$discounts)
    {
        $this->title = $title;
        $this->img = $img;
        $this->price = $price;
        $this->qtyInc = $qtyInc;
    }

    public function getTitle() : string
    {
        return $this->title;
    }

    public function getImg() : string
    {
        return $this->img;
    }

    public function getPrice() : float
    {
        return $this->price;
    }

    public function getQtyInc() : int
    {
        return $this->qtyInc;
    }
}
