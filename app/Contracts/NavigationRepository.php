<?php

namespace PingPongShop\Contracts;

use PingPongShop\NavigationItem;

interface NavigationRepository
{
    function getItems(string $activeView) : array;

    function getCheckoutItem(string $activeView) : NavigationItem;
}
