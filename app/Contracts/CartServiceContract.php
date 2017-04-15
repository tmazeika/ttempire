<?php

namespace TTEmpire\Contracts;

use Illuminate\Support\Collection;
use TTEmpire\Product;
use TTEmpire\SubQuantity;

interface CartServiceContract
{
    public function addCount(Product $product, SubQuantity $subQuantity, int $count): int;

    public function setCount(Product $product, SubQuantity $subQuantity, int $count): int;

    public function getCount(Product $product, SubQuantity $subQuantity): int;

    public function getTotalCount(): int;

    public function getSubtotal(): int;

    public function allCartItems(): Collection;

    public function all(): Collection;

    public function getShippingPrice(): int;
}
