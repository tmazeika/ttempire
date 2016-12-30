<?php

namespace PingPongShop\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home')->with(parent::TitleKey, 'Home');
    }
}
