<?php

/**
 * Topページのコントローラクラスです。
 */
class TopController extends Controller
{
    /**
     * Topページの表示処理を行うアクションメソッドです。
     * POSTリクエストが送信された場合、メニュー情報を取得してレンダリングします。
     *
     * @return string TopページのHTMLコンテンツ
     */
    public function index() :string
    {
        /* @var array<array{'name':string}> */
        $results = [];

        if (isset($_POST['shuffle'])) {
            $results[] = $this->databaseManager->get('Menu')->fetchAssocUdon();
            //TODO: 1を定数化する。
            if ($_POST['mode'] === '1') {
                $results[] = $this->databaseManager->get('Menu')->fetchAssocTempura();
            }
        }

        return $this->render([
            'results' => $results,
        ], 'index');
    }
}
