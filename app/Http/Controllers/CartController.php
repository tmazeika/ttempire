<?php

namespace TTEmpire\Http\Controllers;

use Illuminate\Http\JsonResponse;
use TTEmpire\CartItem;
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
        return view('shop.cart', ['cartItems' => $this->cartService->allCartItems()]);
    }

    public function add(Product $product, SubQuantity $subQuantity)
    {
        return $this->buildResponse($subQuantity, function () use ($product, $subQuantity) {
            return $this->cartService->addCount($product, $subQuantity, 1);
        });
    }

    public function subtract(Product $product, SubQuantity $subQuantity)
    {
        return $this->buildResponse($subQuantity, function () use ($product, $subQuantity) {
            return $this->cartService->addCount($product, $subQuantity, -1);
        });
    }

    public function set(Product $product, SubQuantity $subQuantity, int $count)
    {
        return $this->buildResponse($subQuantity, function () use ($product, $subQuantity, $count) {
            return $this->cartService->setCount($product, $subQuantity, $count);
        });
    }

    private function buildResponse(SubQuantity $subQuantity, \Closure $countSetter): JsonResponse
    {
        $count = $countSetter();

        return response()->json([
            'sub_qty' => $subQuantity->id,
            'sub_qty_count' => $count,
            'subtotal' => $subQuantity->usdPrice($count),
            'cart_count' => $this->cartService->getTotalCount(),
            'total' => $this->cartService->getSubtotal() + 6,
        ]);
    }
}
