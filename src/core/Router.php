<?php

/**
 * HTTPリクエストのパスを適切なコントローラーアクションにルーティングします。
 */
class Router
{
    /* @var array<string, array<string, string>> */
    // TODO: 変数名がちょっと抽象的かも？
    private $routes;

    /**
     * コンストラクタ
     *
     * @param array<string, array<string, string>> $routes 登録するルート情報の配列
     *
     * @return void
     */
    public function __construct($routes)
    {
        $this->routes = $routes;
    }

    /**
     * HTTPリクエストパスと登録済みのルート情報を照らし合わせて解決します。
     *
     * //TODO: 変数名に改良の余地あり？
     * @param string $pathInfo
     *
     * @return array{'controller': string, 'action': string}|false 登録されたルート情報のパターンに一致する処理を返します。一致するパターンがない場合はfalseを返します。
     */
    public function resolve($pathInfo)
    {
        foreach ($this->routes as $path => $pattern) {
            if ($path === $pathInfo) {
                return $pattern;
            }
        }

        return false;
    }
}
