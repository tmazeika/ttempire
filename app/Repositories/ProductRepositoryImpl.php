<?php

namespace TTEmpire\Repositories;

use TTEmpire\Contracts\ProductRepository;
use TTEmpire\Product;
use TTEmpire\ProductDiscount;
use TTEmpire\ProductQuantity;

class ProductRepositoryImpl implements ProductRepository
{
    /** @var Product[] */
    private $products;

    public function __construct()
    {
        $this->products = [
            new Product('kingnik-1-star', 'products.1star.title', 'products.1star.desc', 'img/product_1star.svg', ...[
                new ProductQuantity(0.40, 100),
                new ProductQuantity(0.38, 500),
                new ProductQuantity(0.37, 1000),
                new ProductQuantity(0.35, 1500),
            ]),

            new Product('kingnik-3-star', 'products.3star.title', 'products.3star.desc', 'img/product_3star.svg', ...[
                new ProductQuantity(1.08, 48),
                new ProductQuantity(1.00, 120),
                new ProductQuantity(0.98, 300),
            ]),
        ];
    }

    /**
     * @return Product[]
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    /**
     * @param string $id
     *
     * @return Product|null
     */
    function getProductById(string $id)
    {
        foreach ($this->products as $product) {
            if ($product->getId() === $id) {
                return $product;
            }
        }

        return null;
    }
}
