<?php

namespace PingPongShop;

class Product
{
    private $id;

    public function __construct(string $title, string $desc, string $img, ProductQuantity ...$quantities)
    {
        $this->title = $title;
        $this->desc = $desc;
        $this->img = $img;
        $this->quantities = $quantities;
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

    public function getQuantities() : array
    {
        return $this->quantities;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }
}
