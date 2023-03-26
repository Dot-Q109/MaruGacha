<?php

/**
 * MySQLの接続とモデルの取得を行います。
 */
class DatabaseManager
{
    /* @var PDO */
    protected $dbh;

    /* @var array<string, mixed> */
    protected $models;

    /**
     * MySQLに接続します。
     * TODO: 変数名と関数名を変える。変数名はもっと具体的に、関数名はMySQLのみへの接続メソッドである旨を記載。
     * @param array<string, string> $params
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
     * @param string $modelName
     *
     * @return mixed インスタンス化されたモデル
     */
    public function get($modelName)
    {
        $model = new $modelName($this->dbh);
        $this->models[$modelName] = $model;

        return $this->models[$modelName];
    }
}
