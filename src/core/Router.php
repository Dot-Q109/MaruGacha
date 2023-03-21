<?php

/**
 * HTTPリクエストのパスを、適切なコントローラアクションに振り分けます。
 */
class Router
{
    /**
     * 登録されたルート情報を保持する配列
     *
     * @var array<string, array<string, string>>
     */
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
     * HTTPリクエストのパスと登録済みのルート情報を名前解決する。
     *
     * @param string $pathInfo HTTPリクエストのパス
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
