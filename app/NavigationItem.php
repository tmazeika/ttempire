<?php

namespace TTEmpire;

class NavigationItem
{
    public function __construct(string $title, string $url, bool $active)
    {
        $this->title = $title;
        $this->url = $url;
        $this->active = $active;
    }

    public function getTitle() : string
    {
        return $this->title;
    }

    public function getUrl() : string
    {
        return $this->url;
    }

    public function isActive() : bool
    {
        return $this->active;
    }
}
