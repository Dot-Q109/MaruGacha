<?php

/**
 * Aboutページに関連する処理を行うコントローラクラスです。
 */
class AboutController extends Controller
{
    /**
     * Aboutページの表示処理を行うアクションメソッドです。
     *
     * @return string AboutページのHTMLコンテンツを返します。
     */
    public function index()
    {
        return $this->render([
            'title' => 'このサイトについて'
        ], 'index');
    }
}
