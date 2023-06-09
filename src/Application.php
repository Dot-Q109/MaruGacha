<?php

/**
 * アプリケーション全体を管轄します。
 * ルーティングの解決、コントローラの実行、レスポンスの送信などの主要な処理を実行します。
 */

class Application
{
    /* @var Router */
    protected $router;

    /* @var Response */
    protected $response;

    /* @var DatabaseManager */
    protected $databaseManager;

    /* @var Dotenv\Dotenv */
    protected $dotenv;

    public function __construct()
    {
        // .envファイルを読み込み、環境変数を設定する
        $this->dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/config');
        $this->dotenv->load();

        $this->router = new Router($this->registerRoutes());
        $this->response = new Response();
        $this->databaseManager = new DatabaseManager(
            [
                'hostname' => $_ENV['DB_HOST'],
                'username' => $_ENV['DB_USERNAME'],
                'password' => $_ENV['DB_PASSWORD'],
                'database' => $_ENV['DB_DATABASE'],
            ]
        );

    }

    /**
     * runメソッド
     *
     * HTTPリクエストパスに応じたルーティングを解決し、対応するアクションを実行します。
     * ルーティングが解決できない場合、404ページを表示します。
     * アクションの実行後、レスポンスを送信します。
     *
     * @throws HttpNotFoundException ルーティングが解決できない場合にスローします。
     *
     * @return void
     */
    public function run()
    {
        try {
            $params = $this->router->resolve($this->getPathInfo());

            $controller = $params['controller'];
            $action = $params['action'];
            $this->runAction($controller, $action);

        } catch (HttpNotFoundException $e) {
            $this->render404Page($e);
        } catch (PDOException | RuntimeException $e) {
            $this->render500Page($e);
        }

        $this->response->sendResponse();
    }

    /**
     * 指定されたコントローラのアクションを実行し、結果をレスポンスに設定します。
     *
     * @param string $controllerName
     * @param string $action
     *
     * @throws HttpNotFoundException コントローラクラスが存在しない場合にスローします。
     *
     * @return void
     */
    private function runAction($controllerName, $action)
    {
        $controllerClassName = ucfirst($controllerName) . 'Controller';
        if (!class_exists($controllerClassName)) {
            throw new HttpNotFoundException();
        }

        $controller = new $controllerClassName($this);
        $responseBody = $controller->run($action);
        $this->response->setResponseBody($responseBody);
    }

    /**
     * HTTPリクエストパスを取得します。
     *
     * @return string HTTPリクエストパス
     */
    public function getPathInfo()
    {
        return $_SERVER['REQUEST_URI'];
    }

    /**
     * コントローラとアクションのルーティング定義を登録します。
     * TODO:定義を外部ファイルや設定ファイルに移管するか検討。
     *
     * @return array<string, array<string, string>> ルーティング定義
     */
    private function registerRoutes()
    {
        return [
            '/' => ['controller' => 'top', 'action' => 'index'],
            '/about' => ['controller' => 'about', 'action' => 'index'],
        ];
    }

    /**
     * データベースマネージャーインスタンスを取得します。
     *
     * @return DatabaseManager
     */
    public function getDatabaseManager()
    {
        return $this->databaseManager;
    }

    /**
     * 404エラーページをレンダリングします。
     *
     * @return void
     */
    private function render404Page(Throwable $e)
    {
        $this->response->setStatusCode(404, 'Not Found');
        $this->response->setResponseBody('404 Page Not Found: ' . $e->getMessage());
    }

    /**
     * 500エラーページをレンダリングします。
     *
     * @return void
     */
    private function render500Page(Throwable $e)
    {
        $this->response->setStatusCode(500, 'Internal Server Error');
        $this->response->setResponseBody('An error occurred: ' . $e->getMessage());
    }

}
