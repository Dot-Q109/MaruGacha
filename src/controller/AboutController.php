<?php

/**
 * Aboutページのコントローラクラスです。
 */
class AboutController extends Controller
{
    /**
     * Aboutページの表示処理を行うアクションメソッドです。
     *
     * @return string AboutページのHTMLコンテンツ
     */
    public function index()
    {
        return $this->render([
        ], 'index');
    }
}
