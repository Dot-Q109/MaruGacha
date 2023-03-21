<?php

/**
 * Topページのコントローラクラスです。
 */
class TopController extends Controller
{
    /**
     * Topページの表示処理を行うアクションメソッドです。
     *
     * @return string TopページのHTMLコンテンツ
     */
    public function index() :string
    {
        /**
         * データベースから取得した結果を格納する配列
         *
         * @var array<array{'name':string}>
         */
        $results = [];

        if (isset($_POST['shuffle'])) {
            $results[] = $this->databaseManager->get('Menu')->fetchAssocUdon();
            if ($_POST['mode'] === '1') {
                $results[] = $this->databaseManager->get('Menu')->fetchAssocTempura();
            }
        }

        return $this->render([
            'results' => $results,
        ], 'index');
    }
}
