<?php

/**
 * ビューを管理します。
 */
class View
{
    /**
     * テンプレートファイルの格納先
     *
     * @var string
     */
    protected $baseDir;

    /**
     * コンストラクタ
     *
     * @param string $baseDir /var/www/html/views
     */
    public function __construct($baseDir)
    {
        $this->baseDir = $baseDir;
    }

    /**
     * views配下のファイルを読み込み、HTMLをレンダリングします。
     *
     * @SuppressWarnings(PHPMD.UnusedLocalVariable)
     *
     * //TODO: 変数名を変更する。
     * @param string $path
     * @param array<mixed>  $variables
     * @param string $layout
     *
     * @return string テンプレートを適用した結果の文字列
     */
    public function render($path, $variables, $layout)
    {
        extract($variables);

        ob_start();
        require $this->baseDir . '/' . $path  . '.php';
        // $contentはレイアウトファイルで使用しています。
        $content =  ob_get_clean();

        ob_start();
        require $this->baseDir . '/' . $layout . '.php';
        $layout = ob_get_clean();

        return $layout;
    }
}
