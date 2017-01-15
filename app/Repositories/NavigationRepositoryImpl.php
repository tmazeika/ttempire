<?php

namespace PingPongShop\Repositories;

use PingPongShop\Contracts\NavigationRepository;
use PingPongShop\NavigationItem;

class NavigationRepositoryImpl implements NavigationRepository
{
    function getItems(string $activeView) : array
    {
        return [
            new NavigationItem('page.title.shop', url('/shop'), $activeView === 'shop'),
            new NavigationItem('page.title.blog', 'https://mazeika.me', false),
            new NavigationItem('page.title.contact', url('/contact'), $activeView === 'contact'),
        ];
    }
}
