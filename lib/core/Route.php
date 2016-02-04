<?php
namespace Lib\Core;

class Route
{
    public $urls;

    public function __construct()
    {
        $this->urls = [];
    }

    public function get($url, $action)
    {
        $this->urls[] = ['method' => 'GET', 'url' => $url, 'action' => $action];
    }

    public function post($url, $action)
    {
        $this->urls[] = ['method' => 'POST', 'url' => $url, 'action' => $action];
    }
}