<?php

/**
 * コントローラの基底クラスです。
 */
class Controller
{
    /* @var const */
    protected const CONTROLLER_SUFFIX_LENGTH = -10;

    /* @var string */
    protected string $actionName;

    /* @var DatabaseManager */
    protected DatabaseManager $databaseManager;


    /**
     * コンストラクタ
     *
     * @param Application $application
     */
    public function __construct(Application $application)
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
    public function run(string $action): string
    {
        $this->actionName = $action;
        if (!method_exists($this, $action)) {
            throw new HttpNotFoundException();
        }
        $renderedHtml = $this->$action();
        return $renderedHtml;
    }

    /**
     * レンダリングを行います。
     *
     * @param array<mixed> $variables
     * @param string|null $template
     * @param string $layoutFileName
     *
     * @return string レンダリングされたHTMLコンテンツ
     */
    protected function render(array $variables = [], ?string $template = null, string $layoutFileName = 'layout'): string
    {
        $view = new View(__DIR__ . '/../views');

        if (is_null($template)) {
            $template = $this->actionName;
        }

        $controllerName = strtolower(substr(get_class($this), 0, self::CONTROLLER_SUFFIX_LENGTH));
        $viewFilePath = $controllerName . '/' . $template;
        return $view->render($viewFilePath, $variables, $layoutFileName);
    }
}
