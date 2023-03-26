<?php

/**
 * HTTPレスポンスやコンテンツを管理します。
 */
class Response
{
    /* @var string */
    protected $content;

    /* @var int */
    protected $statusCode;

    /* @var string */
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
     * コンテンツ本文を設定します。
     *
     * @param string $content
     *
     * @return void
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * ステータスコードとステータステキストを設定します。
     *
     * @param int $statusCode
     * @param string $statusText
     *
     * @return void
     */
    public function setStatusCode($statusCode, $statusText)
    {
        $this->statusCode = $statusCode;
        $this->statusText = $statusText;
    }
}
