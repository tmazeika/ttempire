<?php

namespace PingPongShop;

use Illuminate\Http\Request;
use PingPongShop\Contracts\ProductRepository;

class ShoppingCart
{
    const SESSION_KEY = 'cart';

    protected $items;

    public function __construct(Request $request, ProductRepository $products)
    {
        $this->request = $request;
        $this->products = $products;

        // load from session if possible
        if ($request->session()->has(self::SESSION_KEY)) {
            $this->items = $request->session()->get(self::SESSION_KEY);
        }
        else {
            $this->items = [];
        }
    }

    public function add(int $id, int $qty) : void
    {
        if (!isset($this->items[$id])) {
            $this->items[$id] = $qty;
        }
        else {
            $this->items[$id] += $qty;
        }

        $this->updateSession();
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

    public function getProductSize() : int
    {
        return sizeof($this->items);
    }

    public function getCost() : float
    {
        $products = $this->products->getProducts();
        $cost = 0;

        foreach ($this->items as $id => $qty)
        {
            /** @var Product[] $products */
            $cost += $products[$id]->getPrice() * $qty;
        }

        return $cost;
    }

    public function getInfo() : array
    {
        $products = $this->products->getProducts();
        $result = [];

        foreach ($this->items as $id => $qty)
        {
            if ($qty) {
                /** @var Product[] $products */
                array_push($result, [
                    'product' => $products[$id],
                    'qty'     => $qty,
                ]);
            }
        }

        return $result;
    }

    public function set(int $id, int $qty) : void
    {
        $this->items[$id] = $qty;
        $this->updateSession();
    }

    public function updateSession()
    {
        $this->request->session()->set(self::SESSION_KEY, $this->items);
    }
}
