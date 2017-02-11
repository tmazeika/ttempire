<?php

namespace TTEmpire;

class ShoppingCartItem
{
    /** @var ProductQuantity */
    private $quantity;

    public function __construct(Product $product, int $ballsPerBox, int $boxes)
    {
        $this->product = $product;
        $this->ballsPerBox = $ballsPerBox;
        $this->boxes = $boxes;
    }

    public function getCost(): float
    {
        return $this->getQuantity()->getPricePerBox() * $this->boxes;
    }

    public function getQuantity(): ProductQuantity
    {
        return $this->quantity ? $this->quantity : $this->quantity = $this->product->getQuantity($this->ballsPerBox);
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function getBallsPerBox(): int
    {
        return $this->ballsPerBox;
    }

    public function getBoxes(): int
    {
        return $this->boxes;
    }

    public function setBoxes(int $boxes): void
    {
        $this->boxes = $boxes;
    }
}