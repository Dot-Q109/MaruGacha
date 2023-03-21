<?php

/**
 * モデルの基底クラスです。
 */
class DatabaseModel
{
    /**
     * PDOインスタンス
     *
     * @var PDO
     */
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
     * @param string $sql SQL文
     *
     * @return array<string,string>|false SQLの実行結果
     */
    public function fetchAssoc($sql)
    {
        $result = $this->dbh->query($sql);
        return $result->fetch(PDO::FETCH_ASSOC);
    }
}
