<?php
namespace core;

final class Router
{
    private $routes = [];
    private $params = [];

    public function __construct()
    {
        $routes = require 'config/routes.php';
        foreach ($routes as $route => $params)
        {
            $this->add($route, $params);
        }
    }

    private function add($route, $params)
    {
        $route = preg_replace('/{([a-z]+)=([^\}]+)}/', '(?P<\1>\2)', $route);
        $route = '#^'.$route.'$#';
        $this->routes[$route] = $params;
    }

    private function match() : bool
    {
        $url = $_SERVER['REQUEST_URI'];
        foreach ($this->routes as $route => $params)
        {
            if (preg_match($route, $url, $matches))
            {
                foreach ($matches as $key => $value) {
                    if (is_string($key)) {
                        if (is_numeric($value)) {
                            $value = (int)$value;
                        }
                        $params[$key] = $value;
                    }
                }
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    public function start()
    {
        if ($this->match()) {
            $controllerName = 'controllers\\'. ucfirst($this->params['controller']) . 'Controller';
            $actionName = $this->params['action'];
            if (class_exists($controllerName))
            {
                $controller = new $controllerName($this->params);
                if (method_exists($controller, $actionName))
                {
                    $controller->$actionName();
                    return;
                }
            }
        }
        View::showErrorNotFoundPage();
    }
}