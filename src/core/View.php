<?php

/**
 * ビューを管理します。
 */
class View
{
    /* @var string */
    protected string $viewsDir;

    /**
     * コンストラクタ
     *
     * @param string $viewsDir ビューファイルの格納ディレクトリ
     */
    public function __construct(string $viewsDir)
    {
        $this->viewsDir = $viewsDir;
    }

    /**
     * views配下のファイルを読み込み、HTMLをレンダリングします。
     *
     * @SuppressWarnings(PHPMD.UnusedLocalVariable)
     *
     * @param string $viewFilePath
     * @param array<mixed>  $variables
     * @param string $layoutFileName
     *
     * @return string テンプレートを適用した結果の文字列
     */
    public function render(string $viewFilePath, array $variables, string $layoutFileName): string
    {
        extract($variables);

        ob_start();
        require $this->viewsDir . '/' . $viewFilePath  . '.php';
        // $responseBody($layoutFileName)で使用されています。
        // ob_start()およびob_get_clean()で、$responseBodyがレイアウトファイルにて展開されます。
        $responseBody =  ob_get_clean();

        ob_start();
        require $this->viewsDir . '/' . $layoutFileName . '.php';
        $renderedHtml = ob_get_clean();

        return $renderedHtml;
    }
}
