<?php

/**
 * コントローラの基底クラスです。
 */
class Controller
{
    /**
     * アクション名
     *
     * @var string
     */
    protected $actionName;

    /**
     * データベースマネージャーインスタンス
     *
     * @var DatabaseManager
     */
    protected $databaseManager;

    /**
     * コンストラクタ
     *
     * @param Application $application アプリケーションインスタンス
     */
    public function __construct($application)
    {
        $this->databaseManager = $application->getDatabaseManager();
    }

    /**
     * アクションを実行します。
     *
     * @param string $action アクション名
     *
     * @throws HttpNotFoundException アクションが存在しない場合に例外をthrowします。
     *
     * @return string レスポンスコンテンツ
     */
    public function run($action)
    {
        $this->actionName = $action;
        if (!method_exists($this, $action)) {
            throw new HttpNotFoundException();
        }
        $content = $this->$action();
        return $content;
    }

    /**
     * レンダリングを行います。
     *
     * @param array<mixed> $variables
     * @param string|null $template
     * @param string $layout
     *
     * @return string レンダリング結果
     */
    protected function render($variables = [], $template = null, $layout = 'layout')
    {
        $view = new View(__DIR__ . '/../views');

        if (is_null($template)) {
            $template = $this->actionName;
        }

        $controllerName = strtolower(substr(get_class($this), 0, -10));
        $path = $controllerName . '/' . $template;
        return $view->render($path, $variables, $layout);
    }
}
