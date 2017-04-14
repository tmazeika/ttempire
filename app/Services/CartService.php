<?php

namespace TTEmpire\Services;

use Illuminate\Support\Collection;
use TTEmpire\Contracts\CartServiceContract;
use TTEmpire\Product;
use TTEmpire\SubQuantity;

class CartService implements CartServiceContract
{
    public function addCount(Product $product, SubQuantity $subQuantity, int $count): int
    {
        $currentCount = $this->getCount($product, $subQuantity);

        return $this->setCount($product, $subQuantity, $currentCount + $count);
    }

    public function setCount(Product $product, SubQuantity $subQuantity, int $count): int
    {
        if ($count < 0 || $count > PHP_INT_MAX) {
            return 0;
        }

        if ($count === 0) {
            session()->forget("cart.$product->id.$subQuantity->id");
        } else {
            session(["cart.$product->id.$subQuantity->id" => $count]);
        }

        return $count;
    }

    public function getCount(Product $product, SubQuantity $subQuantity): int
    {
        return session("cart.$product->id.$subQuantity->id", 0);
    }

    public function getTotalCount(): int
    {
        return $this->all()->flatten()->sum();
    }

    public function all(): Collection
    {
        return collect(session('cart', []));
    }
}
