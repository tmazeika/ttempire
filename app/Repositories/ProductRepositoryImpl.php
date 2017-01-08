<?php

namespace PingPongShop\Repositories;

use PingPongShop\Contracts\ProductRepository;
use PingPongShop\Product;
use PingPongShop\ProductDiscount;

class ProductRepositoryImpl implements ProductRepository
{
    protected $products;

    public function __construct()
    {
        $this->products = [
            new Product('products.1star.title', 'products.1star.desc', 'img/product_1star.svg', 195, 500),

            new Product('products.3star.title', 'products.3star.desc', 'img/product_3star.svg', 294, 300,
                new ProductDiscount(3, 60)),
        ];

        foreach ($this->products as $i => $product) {
            $product->setId($i);
        }
    }

    public function getProducts(): array
    {
        return $this->products;
    }

    public function getMaxProductIndex(): int
    {
        return count($this->products);
    }
}
