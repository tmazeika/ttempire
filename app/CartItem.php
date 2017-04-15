<?php

namespace TTEmpire;

class CartItem
{
    /** @var Product $product */
    public $product;

    /** @var SubQuantity $subQuantity */
    public $subQuantity;

    /** @var int $count */
    public $count;

    public function __construct(Product $product, SubQuantity $subQuantity, int $count)
    {
        $this->product = $product;
        $this->subQuantity = $subQuantity;
        $this->count = $count;
    }

    public function id(): string
    {
        return $this->product->id . '-' . $this->subQuantity->id;
    }
}
