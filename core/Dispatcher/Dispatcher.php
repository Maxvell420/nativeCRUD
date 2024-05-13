<?php

namespace Core\Dispatcher;

use Core\Route\Route;
use ReflectionMethod;

class Dispatcher
{
    private array $params;
    public function __construct(private Route $route)
    {
        $this->params = $this->getParams($this->route);
    }
    public function getPage()
    {
        $fullName = "\\{$this->route->getController()}";
        $route = $this->route;
        $params = $this->params;
        $controller = new $fullName;
        if (method_exists($controller, $route->getAction())) {
            return $this->dispatch($controller, $route->getAction(), $params);
        } else {
            throw new \Exception("method {$route->getAction()} of {$route->getController()} do not exist");
        }
    }
    private function dispatch(object $object,string $action,array $params)
    {
        return $object->{$action}($params);
    }
    private function getParams(Route $route)
    {
        return match ($route->getMethod()) {
            'GET' => $_GET,
            'POST' => $_POST,
            default => null,
        };
    }
}