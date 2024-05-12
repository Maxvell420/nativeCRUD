<?php

namespace Core\Router;

use Core\Dispatcher\Dispatcher;
use Core\Route\Route;

class Router
{
    public function getRoute(string $uri):Route
    {
        $routes = require __DIR__ . '/../../app/Routes/routes.php';
        foreach ($routes as $route) {
            if ($this->checkRoute($route,$uri)){
                return $route;
            }
        }
        throw new \Exception('route not found');
    }
    private function checkRoute(Route $route,string $uri)
    {
        return str_starts_with($uri,$route->getPath());
    }
}