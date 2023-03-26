<?php

/**
 * HTTPレスポンスやコンテンツを管理します。
 */
class Response
{
    /* @var string */
    protected string $responseBody = '';

    /* @var int */
    protected int $statusCode = 200;

    /* @var string */
    protected string $statusText = 'OK';

    /**
     * レスポンスを送信します。
     *
     * @return void
     */
    public function sendResponse()
    {
        header('HTTP/1.1 ' . $this->statusCode . ' ' . $this->statusText);

        echo $this->responseBody;
    }

    /**
     * コンテンツ本文を設定します。
     *
     * @param string $responseBody
     *
     * @return void
     */
    public function setResponseBody(string $responseBody): void
    {
        $this->responseBody = $responseBody;
    }

    /**
     * ステータスコードとステータステキストを設定します。
     *
     * @param int $statusCode
     * @param string $statusText
     *
     * @return void
     */
    public function setStatusCode(int $statusCode, string $statusText): void
    {
        $this->statusCode = $statusCode;
        $this->statusText = $statusText;
    }
}
