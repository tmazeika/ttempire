<?php

namespace TTEmpire\Contracts;

interface NavigationRepository
{
    function getItems(string $activeView) : array;
}
