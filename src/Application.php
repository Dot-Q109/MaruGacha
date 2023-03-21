<?php

/**
 * アプリケーションクラスです。
 */
class Application
{
    /**
     * ルーターインスタンス
     *
     * @var Router
     */
    protected $router;

    /**
     * レスポンスインスタンス
     *
     * @var Response
     */
    protected $response;

    /**
     * データベースマネージャーインスタンス
     *
     * @var DatabaseManager
     */
    protected $databaseManager;

    /**
     * Dotenvインスタンス
     *
     * @var Dotenv\Dotenv
     */
    protected $dotenv;

    /**
     * コンストラクタ
     */
    public function __construct()
    {
        // .envファイルを読み込み、環境変数を設定する
        $this->dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/config');
        $this->dotenv->load();

        // インスタンスの生成
        $this->router = new Router($this->registerRoutes());
        $this->response = new Response();
        $this->databaseManager = new DatabaseManager();

        // データベースに接続
        $this->databaseManager->connect(
            [
                'hostname' => $_ENV['DB_HOST'],
                'username' => $_ENV['DB_USERNAME'],
                'password' => $_ENV['DB_PASSWORD'],
                'database' => $_ENV['DB_DATABASE'],
            ]
        );
    }


    /**
     * HTTPリクエストを処理し、対応するアクションを呼び出します。
     *
     * @throws HttpNotFoundException パラメータが解決できなかった場合にスローされます。
     *
     * @return void
     */
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

    /**
     * 指定されたコントローラの指定されたアクションを実行します。
     *
     * @param string $controllerName コントローラ名
     * @param string $action アクション名
     *
     * @throws HttpNotFoundException コントローラクラスが存在しない場合にスローされます。
     *
     * @return void
     */
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

    /**
     * 現在のHTTPリクエストパスを取得します。
     *
     * @return string 現在のHTTPリクエストパス
     */
    public function getPathInfo()
    {
        return $_SERVER['REQUEST_URI'];
    }

    /**
     * コントローラとアクションのルーティング定義を登録します。
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
     * @return DatabaseManager データベースマネージャーインスタンス
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
    private function render404Page()
    {
        $this->response->setStatusCode(404, 'Not Found');
        $this->response->setContent('404 Page Not Found.');
    }
}
