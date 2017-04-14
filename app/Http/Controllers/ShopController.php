<?php

namespace TTEmpire\Http\Controllers;

use TTEmpire\Product;

class ShopController extends Controller
{
    public function index()
    {
        return view('shop.index', ['products' => Product::all()]);
    }

    public function showProduct(Product $product)
    {
        $multipleQty = $product->hasMultipleSubQuantities();

        if (!$multipleQty) {
            $subQty = $product->subQuantities->first();
        }

        return view('shop.product', compact('product', 'multipleQty', 'subQty'));
    }
}
