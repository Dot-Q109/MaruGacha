<?php

/**
 * HTTPリクエストのパスを適切なコントローラーアクションにルーティングします。
 */
class Router
{
    /* @var array<string, array<string, string>> */
    private $routeMappings;

    /**
     * コンストラクタ
     *
     * @param array<string, array<string, string>> $routeMappings
     *
     * @return void
     */
    public function __construct(array $routeMappings)
    {
        $this->routeMappings = $routeMappings;
    }

    /**
     * HTTPリクエストパスと登録済みのルート情報を照らし合わせて解決します。
     *
     * @param string $httpRequestPath
     *
     * @return array{'controller': string, 'action': string}|false
     * 登録されたルート情報のパターンに一致する処理を返します。一致するパターンがない場合はfalseを返します。
     */
    public function resolve(string $httpRequestPath)
    {
        foreach ($this->routeMappings as $routePath => $controllerAction) {
            if ($routePath === $httpRequestPath) {
                return $controllerAction;
            }
        }

        throw new HttpNotFoundException('Route not found: ' . $httpRequestPath);
    }
}
