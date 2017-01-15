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
        return view('shop')->with(parent::TITLE_KEY, trans('page.title.shop'));
    }

    public function addCartProductQty(Request $request, ProductRepository $productRepo, ShoppingCart $cart)
    {
        $productId = $request->input('id');

        $this->validate($request, [
            'id'  => 'bail|required|numeric|min:0|max:'.$productRepo->getMaxProductIndex(),
            'qty' => 'bail|required|numeric|min:'.(-$cart->get($productId)),
        ]);

        $cart->add($productId, $request->input('qty'));

        return back();
    }

    public function setCartProductQty(Request $request, ProductRepository $productRepo, ShoppingCart $cart)
    {
        $this->validate($request, [
            'id'  => 'bail|required|numeric|min:0|max:'.$productRepo->getMaxProductIndex(),
            'qty' => 'bail|required|numeric|min:0',
        ]);

        $cart->set($request->input('id'), $request->input('qty'));

        return back();
    }

    public function resetCart(Request $request)
    {
        $request->session()->forget(ShoppingCart::SESSION_KEY);

        return back();
    }
}
