<?php

namespace PingPongShop\Contracts;

interface ProductRepository
{
    function getProducts() : array;

    function getMaxProductIndex() : int;

    function getMaxProductQuantityIndex(int $productId) : int;
}
