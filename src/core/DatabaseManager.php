<?php

/**
 * MySQLの接続とモデルの取得を行います。
 */
class DatabaseManager
{
    /* @var PDO */
    protected ?PDO $dbh = null;

    /* @var array<string, mixed> */
    protected array $models = [];

    /**
     * コンストラクタ
     *
     * MySQLに接続します。
     *
     * @param array<string, string> $params
     *
     * @throws PDOException 接続に失敗した場合にスローします。
     *
     * @return void
     */
    public function __construct(array $params)
    {
        try {
            $dsn = "mysql:dbname={$params['database']};host={$params['hostname']};";
            $user = $params['username'];
            $password = $params['password'];

            $this->dbh = new PDO($dsn, $user, $password);
            // エラー発生時にPDOExceptionを投げるよう設定。
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * モデルのインスタンスを取得します。
     *
     * @param string $modelName
     *
     * @return mixed
     */
    public function getModelInstance($modelName)
    {
            $this->models[$modelName] = new $modelName($this->dbh);
            return $this->models[$modelName];
    }
}
