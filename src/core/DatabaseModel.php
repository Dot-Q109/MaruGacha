<?php

/**
 * データベースモデルの基底クラスです。
 */
class DatabaseModel
{
    /* @var PDO */
    protected PDO $dbh;

    /**
     * コンストラクタ
     *
     * @param PDO $dbh
     */
    public function __construct(PDO $dbh)
    {
        $this->dbh = $dbh;
    }

    /**
     * SQLを実行し、結果を連想配列として取得します。
     * TODO:SQL文の受け取りと実行を改善する。
     *
     * @param string $sql
     *
     * @return array<string,string>|false SQLの実行結果、失敗した場合はfalse
     */
    public function fetchAssoc(string $sql)
    {
        $result = $this->dbh->query($sql);

        return $result->fetch(PDO::FETCH_ASSOC);
    }
}
