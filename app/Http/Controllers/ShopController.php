<?php

namespace PingPongShop\Http\Controllers;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        return view('shop')->with(parent::TITLE_KEY, trans('page.title.shop'));
    }
}
