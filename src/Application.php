<?php

class Application{

    private $router;
    private $response;

    public function __construct()
    {
        $this->router = new Router($this->registerRoutes());
        $this->response = new Response;
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

        $this->response->send();
    }

    private function runAction($controllerName, $action)
    {
        $controllerClass = ucfirst($controllerName) . 'Controller';
        if (!class_exists($controllerClass)) {
            throw new HttpNotFoundException();
        }

        $controller = new $controllerClass();
        $content = $controller->run($action);
        $this->response->setContent($content);
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
        $this->response->setStatusCode(404, 'Not Found');
        $this->response->setContent('404 Page Not Found.');
    }
}
