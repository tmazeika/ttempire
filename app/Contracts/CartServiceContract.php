<?php

namespace TTEmpire\Contracts;

use Illuminate\Support\Collection;
use TTEmpire\Product;
use TTEmpire\SubQuantity;

interface CartServiceContract
{
    public function addCount(Product $product, SubQuantity $subQuantity, int $count): void;

    public function setCount(Product $product, SubQuantity $subQuantity, int $count): void;

    public function getCount(Product $product, SubQuantity $subQuantity): int;

    public function getTotalCount(): int;

    public function all(): Collection;
}
