<?php

namespace TTEmpire\Http\Controllers;

use Illuminate\Http\Request;
use TTEmpire\Contracts\ProductRepository;
use TTEmpire\CurrencyConverter;
use TTEmpire\ShoppingCart;

class ShopController extends Controller
{
    public function index()
    {
        return view('shop.index')->with(parent::TITLE_KEY, trans('page.title.shop.index'));
    }

    public function showProduct(ProductRepository $productRepo, string $id)
    {
        $product = $productRepo->getProductById($id);

        return view('shop.product')->with([
            parent::TITLE_KEY => trans($product->getTitle()),
            'product'         => $product,
        ]);
    }

    public function showCart(ShoppingCart $cart)
    {
        if ($cart->getTotalBoxes()) {
            return view('shop.cart')->with([
                parent::TITLE_KEY => 'Cart',
                'cartActive'      => true,
            ]);
        }

        return redirect('/shop');
    }

    public function addCartProductQty(Request $request, ShoppingCart $cart)
    {
        $id = $request->input('id');
        $bpb = $request->input('bpb');

        $this->validate($request, [
            'id'  => 'bail|required',
            'bpb' => 'bail|required|integer|min:0',
            'boxes' => 'bail|required|integer|min:'.-$cart->getBoxes($id, $bpb).'|max:1',
        ]);
        $cart->addBoxes($id, $bpb, $request->input('boxes'));

        return back();
    }

    public function setCartProductQty(Request $request, ShoppingCart $cart)
    {
        $id = $request->input('id');
        $bpb = $request->input('bpb');

        $this->validate($request, [
            'id'  => 'bail|required',
            'bpb' => 'bail|required|integer|min:0',
            'boxes' => 'bail|required|integer|min:0|max:999',
        ]);
        $cart->setBoxes($id, $bpb, $request->input('boxes'));

        return back();
    }

    public function resetCart(Request $request)
    {
        $request->session()->forget(ShoppingCart::SESSION_KEY);

        return back();
    }
}
