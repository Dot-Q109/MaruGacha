<?php

class Application{

    protected $router;
    protected $response;
    protected $databaseManager;
    protected $dotenv;

    public function __construct()
    {
        $this->dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/config');
        $this->dotenv->load();

        $this->router = new Router($this->registerRoutes());
        $this->response = new Response;
        $this->databaseManager = new DatabaseManager();
        $this->databaseManager = new DatabaseManager();
        $this->databaseManager->connect(
            [
                'hostname' => $_ENV['DB_HOST'],
                'username' => $_ENV['DB_USERNAME'],
                'password' => $_ENV['DB_PASSWORD'],
                'database' => $_ENV['DB_DATABASE'],
            ]
        );
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

        $controller = new $controllerClass($this);
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

    public function getDatabaseManager()
    {
        return $this->databaseManager;
    }

    private function render404Page()
    {
        $this->response->setStatusCode(404, 'Not Found');
        $this->response->setContent('404 Page Not Found.');
    }
}
