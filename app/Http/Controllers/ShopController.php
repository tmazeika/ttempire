<?php

namespace TTEmpire\Http\Controllers;

use Braintree_ClientToken;
use Braintree_Transaction;
use Illuminate\Http\Request;
use TTEmpire\Contracts\ProductRepository;
use TTEmpire\ShoppingCart;

class ShopController extends Controller
{
    public function index()
    {
        return view('shop.index')->with(parent::TITLE_KEY, trans('page.title.shop.index'));
    }

    public function showProduct(ProductRepository $productRepo, int $id)
    {
        return view('shop.product')->with([
            parent::TITLE_KEY => trans($productRepo->getProducts()[$id]->getTitle()),
            'product' => $productRepo->getProducts()[$id],
        ]);
    }

    public function addCartProductQty(Request $request, ProductRepository $productRepo, ShoppingCart $cart)
    {
        $productId = $request->input('id');
        $qty = $request->input('qty');

        $this->validate($request, [
            'id'  => 'bail|required|integer|min:0|max:'.$productRepo->getMaxProductIndex(),
            'qty' => 'bail|required|integer|min:0|max:'.$productRepo->getMaxProductQuantityIndex($productId),
            'num' => 'bail|required|integer|min:'.(-$cart->get($productId, $qty)).'|max:1',
        ]);

        $cart->add($productId, $qty, $request->input('num'));

        return back();
    }

    public function setCartProductQty(Request $request, ProductRepository $productRepo, ShoppingCart $cart)
    {
        $productId = $request->input('id');
        $qty = $request->input('qty');

        $this->validate($request, [
            'id'  => 'bail|required|integer|min:0|max:'.$productRepo->getMaxProductIndex(),
            'qty' => 'bail|required|integer|min:0|max:'.$productRepo->getMaxProductQuantityIndex($productId),
            'num' => 'bail|required|integer|min:0|max:999',
        ]);

        $cart->set($productId, $qty, $request->input('num'));

        return back();
    }

    public function resetCart(Request $request)
    {
        $request->session()->forget(ShoppingCart::SESSION_KEY);

        return back();
    }
}
