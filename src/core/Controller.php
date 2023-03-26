<?php

/**
 * コントローラの基底クラスです。
 */
class Controller
{
    /* @var string */
    protected $actionName;

    /* @var DatabaseManager */
    protected $databaseManager;

    /**
     * コンストラクタ
     *
     * @param Application $application
     */
    public function __construct($application)
    {
        $this->databaseManager = $application->getDatabaseManager();
    }

    /**
     * アクションを実行します。
     *
     * @param string $action
     *
     * @throws HttpNotFoundException
     *
     * @return string
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
     * @return string レンダリングされたHTMLコンテンツ
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
