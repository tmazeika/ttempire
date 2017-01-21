<?php

namespace PingPongShop;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use PingPongShop\Contracts\ProductRepository;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

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

    public function add(int $id, int $qty, int $num) : void
    {
        if (isset($this->items[$id][$qty])) {
            $this->items[$id][$qty] += $num;
        }
        else {
            $this->items[$id][$qty] = $num;
        }

        $this->validateQuantity($this->items[$id][$qty]);
        $this->updateSession();
    }

    public function get(int $id, int $qty) : int
    {
        return isset($this->items[$id][$qty]) ? $this->items[$id][$qty] : 0;
    }

    public function getProductSize() : int
    {
        $num = 0;

        foreach ($this->items as $id => $qty) {
            if ($qty) {
                foreach ($qty as $qtyId => $qtyNum) {
                    $num += $qtyNum;
                }
            }
        }

        return $num;
    }

    public function getInfo() : array
    {
        $products = $this->products->getProducts();
        $result = [];

        foreach ($this->items as $id => $qty)
        {
            /** @var Product $product */
            $product = $products[$id];

            $p = [
                'product' => $product,
            ];

            foreach ($qty as $qtyId => $qtyNum) {
                if ($qtyNum) {
                    $p['qty'][$qtyId]['num'] = $qtyNum;
                    $p['qty'][$qtyId]['price'] = CurrencyConverter::convert('EUR', trans('currency.code'), $product->getQuantities()[$qtyId]->getPricePerBox(), 2);
                }
            }

            if (isset($p['qty'])) {
                array_push($result, $p);
            }
        }

        return $result;
    }

    public function set(int $id, int $qty, int $num) : void
    {
        $this->validateQuantity($qty);
        $this->items[$id][$qty] = $num;
        $this->updateSession();
    }

    public function updateSession()
    {
        $this->request->session()->set(self::SESSION_KEY, $this->items);
    }

    private function validateQuantity(int $qty) : void
    {
        if ($qty >= 1000) {
            throw new BadRequestHttpException('Item quantity exceeds maximum');
        }
    }
}
