<?php

namespace TTEmpire\Contracts;

use TTEmpire\Product;

interface ProductRepository
{
    /**
     * @return Product[]
     */
    function getProducts(): array;

    /**
     * @param string $id
     *
     * @return Product|null
     */
    function getProductById(string $id);
}
