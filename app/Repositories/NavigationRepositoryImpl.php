<?php

namespace TTEmpire\Repositories;

use TTEmpire\Contracts\NavigationRepository;
use TTEmpire\NavigationItem;

class NavigationRepositoryImpl implements NavigationRepository
{
    function getItems(string $activeView) : array
    {
        return [
            new NavigationItem('page.title.shop.index', url('/shop'), $activeView === 'shop.index'),
            new NavigationItem('page.title.contact', url('/contact'), $activeView === 'contact'),
        ];
    }
}
