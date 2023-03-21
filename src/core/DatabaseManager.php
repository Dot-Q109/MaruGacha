<?php

/**
 * Class DatabaseManager
 *
 * MySQLの接続とモデルの取得を行います。
 */
class DatabaseManager
{
    /**
     * PDOインスタンス
     *
     * @var PDO
     */
    protected $dbh;

    /**
     * モデルインスタンスを格納する配列
     *
     * @var array<string, mixed>
     */
    protected $models;

    /**
     * MySQLに接続します。
     *
     * @param array<string, string> $params データベース接続情報
     *
     * @return void
     */
    public function connect($params)
    {
        try {
            $dsn = "mysql:dbname={$params['database']};host={$params['hostname']};";
            $user = $params['username'];
            $password = $params['password'];

            $this->dbh = new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * モデルのインスタンスを取得します。
     *
     * @param string $modelName モデル名
     *
     * @return mixed モデルインスタンス
     */
    public function get($modelName)
    {
        $model = new $modelName($this->dbh);
        $this->models[$modelName] = $model;

        return $this->models[$modelName];
    }
}
