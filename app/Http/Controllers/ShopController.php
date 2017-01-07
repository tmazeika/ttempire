<?php

namespace PingPongShop\Http\Controllers;

use Braintree_ClientToken;
use Braintree_Transaction;

class ShopController extends Controller
{
    public function index()
    {
        return view('shop.index')->with(parent::TITLE_KEY, trans('page.title.shop.index'));
    }

    public function showCheckout()
    {
        return view('shop.checkout')->with([
            parent::TITLE_KEY => trans('page.title.shop.checkout'),
            'braintreeToken' => Braintree_ClientToken::generate(),
        ]);
    }

    public function checkout()
    {
        $result = Braintree_Transaction::sale([
            'amount' => '10.00',
            'paymentMethodNonce' => request()->input('payment_method_nonce'),
            'options' => [
                'submitForSettlement' => true,
            ],
        ]);

        dump($result);
    }
}
