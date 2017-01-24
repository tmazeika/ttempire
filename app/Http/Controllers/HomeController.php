<?php

namespace TTEmpire\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        return view('home')->with(parent::TITLE_KEY, trans('page.title.home'));
    }
}
