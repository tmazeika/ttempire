<?php

namespace PingPongShop\Contracts;

interface NavigationRepository
{
    function getItems(string $activeView) : array;
}
