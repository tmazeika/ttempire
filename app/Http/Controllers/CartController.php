<?php

namespace TTEmpire\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use TTEmpire\Contracts\CartServiceContract;
use TTEmpire\Contracts\CurrencyServiceContract;
use TTEmpire\Product;
use TTEmpire\SubQuantity;

class CartController extends Controller
{
    /** @var CartServiceContract $cartService */
    private $cartService;

    /** @var CurrencyServiceContract $currencyService */
    private $currencyService;

    public function __construct(CartServiceContract $cartService, CurrencyServiceContract $currencyService)
    {
        $this->cartService = $cartService;
        $this->currencyService = $currencyService;
    }

    public function index()
    {
        return view('shop.cart', ['cartItems' => $this->cartService->allCartItems()]);
    }

    public function add(Request $request, Product $product, SubQuantity $subQuantity)
    {
        return $this->buildResponse($request, $subQuantity, function () use ($product, $subQuantity) {
            return $this->cartService->addCount($product, $subQuantity, 1);
        });
    }

    public function subtract(Request $request, Product $product, SubQuantity $subQuantity)
    {
        return $this->buildResponse($request, $subQuantity, function () use ($product, $subQuantity) {
            return $this->cartService->addCount($product, $subQuantity, -1);
        });
    }

    public function set(Request $request, Product $product, SubQuantity $subQuantity, int $count)
    {
        return $this->buildResponse($request, $subQuantity, function () use ($product, $subQuantity, $count) {
            return $this->cartService->setCount($product, $subQuantity, $count);
        });
    }

    private function buildResponse(Request $request, SubQuantity $subQuantity, \Closure $countSetter): JsonResponse
    {
        $count = $countSetter();
        $total = $this->cartService->getSubtotal();
        $response = [];

        if ($request->input('in_cart')) {
            $response = [
                'subtotal'      => $this->currencyService->getAndFormatPrice($subQuantity, 0, $count),
                'total'         => $this->currencyService->formatPrice($total, 0),
                'total_raw'     => $this->currencyService->getFloatPrice($total),
                'paypal_button' => view()->make('partials.shop.paypal-button', [
                    'cartItems' => $this->cartService->allCartItems(),
                    'currencyService' => $this->currencyService,
                ])->render(),
            ];
        }

        return response()->json(array_merge($response, [
            'sub_qty'       => $subQuantity->id,
            'sub_qty_count' => $count,
            'cart_count'    => $this->cartService->getTotalCount(),
        ]));
    }
}
