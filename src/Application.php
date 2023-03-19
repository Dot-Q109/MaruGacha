<?php

class Application{

    private $router;

    public function __construct()
    {
        $this->router = new Router($this->registerRoutes());
    }

    public function run()
    {
        $params = $this->router->resolve($this->getPathInfo());
        $controller = $params['controller'];
        $action = $params['action'];
        $this->runAction($controller, $action);
    }

    private function runAction($controllerName, $action)
    {
        $controllerClass = ucfirst($controllerName) . 'Controller';
        $controller = new $controllerClass();
        $controller->run($action);
    }

    public function getPathInfo()
    {
        return $_SERVER['REQUEST_URI'];
    }

    private function registerRoutes()
    {
        return [
            '/' => ['controller' => 'top', 'action' => 'index'],
            '/about' => ['controller' => 'about', 'action' => 'index'],
        ];
    }
}
