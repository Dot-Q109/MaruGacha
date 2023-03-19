<?php

class Application{

    private $router;

    public function __construct()
    {
        $this->router = new Router($this->registerRoutes());
    }

    public function run()
    {
        try {

            $params = $this->router->resolve($this->getPathInfo());
            if (!$params) {
                throw new  HttpNotFoundException();
            }
            $controller = $params['controller'];
            $action = $params['action'];
            $this->runAction($controller, $action);
        } catch (HttpNotFoundException) {
            $this->render404Page();
        }
    }

    private function runAction($controllerName, $action)
    {
        $controllerClass = ucfirst($controllerName) . 'Controller';
        if (!class_exists($controllerClass)) {
            throw new HttpNotFoundException();
        }
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

    private function render404Page()
    {
        header("https/1.0 404 Not Found");
        echo '404 Page Not Found.';
    }
}
