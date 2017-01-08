<?php

namespace PingPongShop\Repositories;

use PingPongShop\Contracts\NavigationRepository;
use PingPongShop\NavigationItem;

class NavigationRepositoryImpl implements NavigationRepository
{
    function getItems(string $activeView): array
    {
        return [
            new NavigationItem('page.title.shop.index', url('/shop'), $activeView === 'shop.index'),
            new NavigationItem('page.title.blog', '/blog', false),
            new NavigationItem('page.title.contact', url('/contact'), $activeView === 'contact'),
        ];
    }
}
