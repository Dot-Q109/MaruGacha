<?php

/**
 * レスポンスを表すクラスです。
 */
class Response
{
    /**
     * レスポンスの本文
     *
     * @var string
     */
    protected $content;

    /**
     * レスポンスのステータスコード
     *
     * @var int
     */
    protected $statusCode;

    /**
     * レスポンスのステータステキスト
     *
     * @var string
     */
    protected $statusText;

    /**
     * レスポンスを送信します。
     *
     * @return void
     */
    public function send()
    {
        header('HTTP/1.1 ' . $this->statusCode . ' ' . $this->statusText);

        echo $this->content;
    }

    /**
     * レスポンスの本文を設定します。
     *
     * @param string $content レスポンスの本文
     *
     * @return void
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * レスポンスのステータスコードとステータステキストを設定します
     *
     * @param int $statusCode ステータスコード
     * @param string $statusText ステータステキスト
     *
     * @return void
     */
    public function setStatusCode($statusCode, $statusText)
    {
        $this->statusCode = $statusCode;
        $this->statusText = $statusText;
    }
}
