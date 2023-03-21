<?php

/**
 * ビューを表すクラスです。指定されたパスにあるPHPファイルを読み込み、変数を渡すことができます。
 * テンプレート機能を提供し、変数をレンダリングされたビューに渡すことができます。
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
     * @param string $baseDir テンプレートファイルの格納先
     */
    public function __construct($baseDir)
    {
        $this->baseDir = $baseDir;
    }

    /**
     * テンプレートファイルをレンダリングし、テンプレートを適用して返します。
     *
     * @param string $path      テンプレートファイルのパス
     * @param array<mixed>  $variables テンプレートファイルに渡す変数
     * @param string|false $layout テンプレートのレイアウトファイルのパス。falseを指定した場合はレイアウトを使用しません。
     *
     * @return string テンプレートを適用した結果の文字列
     */
    public function render($path, $variables, $layout = false)
    {
        extract($variables);

        ob_start();
        require $this->baseDir . '/' . $path  . '.php';
        $content =  ob_get_clean();

        ob_start();
        require $this->baseDir . '/' . $layout . '.php';
        $layout = ob_get_clean();

        return $layout;
    }
}
