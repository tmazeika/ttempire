<?php

namespace TTEmpire\Services;

use Illuminate\Support\Collection;
use TTEmpire\CartItem;
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

    public function getSubtotal(): int
    {
        return $this
            ->allCartItems()
            ->map(function (CartItem $cartItem) {
                return $cartItem->subQuantity->usd_price * $cartItem->count;
            })
            ->sum() / 100;
    }

    public function allCartItems(): Collection
    {
        // convert a nested array of product ID's to sub-quantity ID's to counts into a flat array of cart items
        return $this
            ->all()
            ->map(function (array $subQuantities, int $productId) {
                return collect($subQuantities)->map(function (int $count, int $subQuantity) use ($productId) {
                    return new CartItem(Product::find($productId), SubQuantity::find($subQuantity), $count);
                });
            })
            ->flatten();
    }

    public function all(): Collection
    {
        return collect(session('cart', []));
    }
}
