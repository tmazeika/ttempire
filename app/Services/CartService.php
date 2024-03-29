<?php

namespace TTEmpire\Services;

use Illuminate\Support\Collection;
use TTEmpire\CartItem;
use TTEmpire\Contracts\CartServiceContract;
use TTEmpire\Contracts\CurrencyServiceContract;
use TTEmpire\Product;
use TTEmpire\SubQuantity;

class CartService implements CartServiceContract
{
    private const SHIPPING_EUR = 600, SHIPPING_USD = 600;

    /** @var CurrencyServiceContract $currencyService */
    private $currencyService;

    public function __construct(CurrencyServiceContract $currencyService)
    {
        $this->currencyService = $currencyService;
    }

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
                return $this->currencyService->getPrice($cartItem->subQuantity) * $cartItem->count;
            })
            ->sum() + $this->getShippingPrice();
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

    public function getShippingPrice(): int
    {
        return $this->currencyService->isEur()
            ? self::SHIPPING_EUR
            : self::SHIPPING_USD;
    }
}
