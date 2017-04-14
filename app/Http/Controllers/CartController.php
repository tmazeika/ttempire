<?php

namespace TTEmpire\Http\Controllers;

use TTEmpire\Product;
use TTEmpire\SubQuantity;

class CartController extends Controller
{
    public function add(Product $product, SubQuantity $subQuantity)
    {
        $count = $this->getCount($product, $subQuantity);

        if ($count === PHP_INT_MAX) {
            abort(400, 'Count Too Large');
        }

        return response()->json([
            'new_count' => $this->setCount($product, $subQuantity, $count + 1),
        ]);
    }

    public function subtract(Product $product, SubQuantity $subQuantity)
    {
        $count = $this->getCount($product, $subQuantity);

        if ($count === 0) {
            abort(400, 'Negative Count');
        }

        return response()->json([
            'new_count' => $this->setCount($product, $subQuantity, $count - 1),
        ]);
    }

    public function set(Product $product, SubQuantity $subQuantity, int $count)
    {
        if ($count < 0) {
            abort(400, 'Negative Count');
        } else if ($count > PHP_INT_MAX) {
            abort(400, 'Count Too Large');
        }

        return response()->json([
            'new_count' => $this->setCount($product, $subQuantity, $count),
        ]);
    }

    private function getCount(Product $product, SubQuantity $subQuantity): int
    {
        return session("cart.$product->id.$subQuantity->id", 0);
    }

    private function setCount(Product $product, SubQuantity $subQuantity, int $count): int
    {
        session(["cart.$product->id.$subQuantity->id" => $count]);

        return $count;
    }
}
