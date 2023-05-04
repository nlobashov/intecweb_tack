<?php

namespace core;

class View
{
    private $route;
    private $path;

    public function __construct($route)
    {
        $this->route = $route;
        $viewName = $this->route['controller'];
        if ($this->route['action'] !== 'index')
        {
            $viewName .= '_' . $this->route['action'];
        }
        $this->path = 'views/' . $viewName . '_view.php';
    }

    public function render($data = [])
    {
        if (file_exists($this->path))
        {
            extract($data);
            require_once $this->path;
        }
    }

    public static function showErrorNotFoundPage()
    {
        http_response_code(404);
        require_once 'views/404_view.php';
        exit();
    }
}