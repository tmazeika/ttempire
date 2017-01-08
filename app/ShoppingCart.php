<?php

namespace PingPongShop;

use Illuminate\Http\Request;

class ShoppingCart
{
    const SESSION_KEY = 'cart';

    protected $items;

    public function __construct(Request $request)
    {
        $this->request = $request;

        // load from session if possible
        if ($request->session()->has(self::SESSION_KEY)) {
            $this->items = $request->session()->get(self::SESSION_KEY);
        }
        else {
            $this->items = [];
        }
    }

    public function add(int $id, int $qty) : int
    {
        if (!isset($this->items[$id])) {
            $this->items[$id] = $qty;
        }
        else {
            $this->items[$id] += $qty;
        }

        $this->updateSession();

        return $this->getSize();
    }

    public function get(int $id) : int
    {
        return isset($this->items[$id]) ? $this->items[$id] : 0;
    }

    public function getSize() : int
    {
        $size = 0;

        foreach ($this->items as $qty) {
            $size += $qty;
        }

        return $size;
    }

    public function set(int $id, int $qty) : int
    {
        $this->items[$id] = $qty;
        $this->updateSession();

        return $this->getSize();
    }

    public function updateSession()
    {
        $this->request->session()->set(self::SESSION_KEY, $this->items);
    }
}
