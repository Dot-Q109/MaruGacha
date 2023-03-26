<?php

/**
 * Topページに関連する処理を行うコントローラクラスです。
 */
class TopController extends Controller
{
    /* @var const */
    const MODE_TEMPURA = '1';

    /**
     * Topページの表示処理を行うアクションメソッドです。
     * POSTリクエストが送信された場合、メニュー情報を取得してレンダリングします。
     *
     * @return string TopページのHTMLコンテンツを返します。
     */
    public function index() :string
    {
        /* @var array<array{'name':string}> */
        $results = [];

        $mode = $_POST['mode'] ?? null;

        if (isset($_POST['shuffle']) && in_array($mode, ['1', '2'], true)) {
            $results[] = $this->databaseManager->getModelInstance('Menu')->fetchRandomUdon();
            if ($_POST['mode'] === self::MODE_TEMPURA) {
                $results[] = $this->databaseManager->getModelInstance('Menu')->fetchRandomTempura();
            }
        }

        return $this->render([
            'results' => $results,
        ], 'index');
    }
}
