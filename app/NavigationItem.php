<?php

namespace PingPongShop;

class NavigationItem
{
    public function __construct(string $title, string $url)
    {
        $this->title = $title;
        $this->url = $url;
    }

    public function getTitle() : string
    {
        return $this->title;
    }

    public function getUrl() : string
    {
        return $this->url;
    }
}
