<?php

namespace TTEmpire\Contracts;

interface ProductRepository
{
    function getProducts() : array;

    function getMaxProductIndex() : int;

    function getMaxProductQuantityIndex(int $productId) : int;
}
