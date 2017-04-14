<?php

namespace TTEmpire\Http\Controllers;

use TTEmpire\Product;

class CartController extends Controller
{
    public function add(Product $product)
    {
        $count = $this->getCount($product);

        if ($count === PHP_INT_MAX) {
            abort(400, 'Count Too Large');
        }

        return response()->json([
            'new_count' => $this->setCount($product, $count + 1),
        ]);
    }

    public function subtract(Product $product)
    {
        $count = $this->getCount($product);

        if ($count === 0) {
            abort(400, 'Negative Count');
        }

        return response()->json([
            'new_count' => $this->setCount($product, $count - 1),
        ]);
    }

    private function getCount(Product $product): int
    {
        return session("cart.$product->id", 0);
    }

    private function setCount(Product $product, int $count): int
    {
        session(["cart.$product->id" => $count]);

        return $count;
    }
}
