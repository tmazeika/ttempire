<?php

namespace PingPongShop\Repositories;

use PingPongShop\Contracts\ProductRepository;
use PingPongShop\Product;
use PingPongShop\ProductDiscount;
use PingPongShop\ProductQuantity;

class ProductRepositoryImpl implements ProductRepository
{
    protected $products;

    public function __construct()
    {
        $this->products = [
            new Product('products.1star.title', 'products.1star.desc', 'img/product_1star.svg',
                new ProductQuantity(100, 0.39),
                new ProductQuantity(500, 0.38),
                new ProductQuantity(1000, 0.37),
                new ProductQuantity(1500, 0.35)
            ),

            new Product('products.3star.title', 'products.3star.desc', 'img/product_3star.svg',
                new ProductQuantity(120, 1),
                new ProductQuantity(300, 0.98)
            ),
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

    function getMaxProductQuantityIndex(int $productId) : int
    {
        return sizeof($this->products[$productId]->getQuantities()) - 1;
    }

}
