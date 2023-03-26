<?php

/**
 * モデルの基底クラスです。
 */
class DatabaseModel
{
    /* @var PDO */
    protected $dbh;

    /**
     * コンストラクタ
     *
     * @param PDO $dbh データベースハンドラ
     */
    public function __construct($dbh)
    {
        $this->dbh = $dbh;
    }

    /**
     * SQLを実行し、結果を連想配列として取得します。
     *
     * @param string $sql
     *
     * @return array<string,string>|false SQLの実行結果、失敗した場合はfalse
     */
    public function fetchAssoc($sql)
    {
        $result = $this->dbh->query($sql);
        return $result->fetch(PDO::FETCH_ASSOC);
    }
}
