<?php

namespace TTEmpire\Http\Controllers;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact')->with(parent::TITLE_KEY, trans('page.title.contact'));
    }
}
