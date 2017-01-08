<?php

namespace PingPongShop;

class Product
{
    private $id;

    public function __construct(string $title, string $desc, string $img, float $price, int $qtyInc, ProductDiscount ...$discounts)
    {
        $this->title = $title;
        $this->desc = $desc;
        $this->img = $img;
        $this->price = $price;
        $this->qtyInc = $qtyInc;
        $this->discounts = $discounts;
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function getTitle() : string
    {
        return $this->title;
    }

    public function getDesc() : string
    {
        return $this->desc;
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

    public function getDiscounts() : array
    {
        return $this->discounts;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }
}
