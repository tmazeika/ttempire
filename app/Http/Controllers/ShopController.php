<?php

namespace PingPongShop\Http\Controllers;

use Braintree_ClientToken;
use Braintree_Transaction;
use Illuminate\Http\Request;
use PingPongShop\Contracts\ProductRepository;
use PingPongShop\ShoppingCart;

class ShopController extends Controller
{
    public function index()
    {
        return view('shop.index')->with(parent::TITLE_KEY, trans('page.title.shop.index'));
    }

    public function addCartProductQty(Request $request, ProductRepository $productRepo, ShoppingCart $cart)
    {
        $productId = $request->input('id');

        $this->validate($request, [
            'id'  => 'bail|required|numeric|min:0|max:'.$productRepo->getMaxProductIndex(),
            'qty' => 'bail|required|numeric|min:'.(-$cart->get($productId)),
        ]);

        return response()->json([
            'product' => $cart->add($productId, $request->input('qty')),
            'total'   => $cart->getSize(),
        ]);
    }

    public function getCartProductQty(Request $request, ProductRepository $productRepo, ShoppingCart $cart)
    {
        $this->validate($request, [
            'id' => 'bail|required|numeric|min:0|max:'.$productRepo->getMaxProductIndex(),
        ]);

        return response()->json([
            'product' => $cart->get($request->input('id')),
            'total'   => $cart->getSize(),
        ]);
    }

    public function setCartProductQty(Request $request, ProductRepository $productRepo, ShoppingCart $cart)
    {
        $this->validate($request, [
            'id'  => 'bail|required|numeric|min:0|max:'.$productRepo->getMaxProductIndex(),
            'qty' => 'bail|required|numeric|min:0',
        ]);

        return response()->json([
            'product' => $cart->set($request->input('id'), $request->input('qty')),
            'total'   => $cart->getSize(),
        ]);
    }

    public function resetCart(Request $request)
    {
        $request->session()->forget(ShoppingCart::SESSION_KEY);
    }

    public function showCheckout()
    {
        return view('shop.checkout')->with([
            parent::TITLE_KEY => trans('page.title.shop.checkout'),
            'braintreeToken'  => Braintree_ClientToken::generate(),
        ]);
    }

    public function checkout(Request $request)
    {
        $result = Braintree_Transaction::sale([
            'amount' => '10.00',
            'paymentMethodNonce' => $request->input('payment_method_nonce'),
            'options' => [
                'submitForSettlement' => true,
            ],
        ]);

        dump($result);
    }
}
