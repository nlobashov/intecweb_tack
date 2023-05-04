<?php

namespace core;

abstract class Controller
{
    protected $data = [];
    protected $route;
    protected $view;

    public function __construct($route)
    {
        $this->route = $route;
        $this->view = new View($route);
    }

    protected function loadModel($name)
    {
        $model = 'models\\' . ucfirst($name);
        if (class_exists($model))
            return new $model();
        else
            throw new \Exception('Не удалось загрузить модель:' . $model);
    }
}
