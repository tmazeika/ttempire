<?php

namespace TTEmpire\Http\Controllers;

use TTEmpire\Contracts\CartServiceContract;
use TTEmpire\Product;
use TTEmpire\SubQuantity;

class CartController extends Controller
{
    /** @var CartServiceContract $cartService */
    private $cartService;

    public function __construct(CartServiceContract $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        return view('shop.cart');
    }

    public function add(Product $product, SubQuantity $subQuantity)
    {
        $this->cartService->addCount($product, $subQuantity, 1);

        return redirect()->back();
    }

    public function subtract(Product $product, SubQuantity $subQuantity)
    {
        $this->cartService->addCount($product, $subQuantity, -1);

        return redirect()->back();
    }

    public function set(Product $product, SubQuantity $subQuantity, int $count)
    {
        $this->cartService->setCount($product, $subQuantity, $count);

        return redirect()->back();
    }
}
