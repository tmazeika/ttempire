<?php

namespace TTEmpire\Http\Controllers;

use TTEmpire\Product;
use TTEmpire\SubQuantity;

class ShopController extends Controller
{
    public function index()
    {
        return view('shop.index');
    }

    public function showProduct(Product $product)
    {
        return view('shop.product', compact('product'), ['multipleQty' => $product->hasMultipleSubQuantities()]);
    }
}
