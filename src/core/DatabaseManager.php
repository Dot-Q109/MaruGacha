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
     * MySQLに接続します。
     *
     * @param array<string, string> $params
     *
     * @throws PDOException 接続に失敗した場合にスローします。
     *
     * @return void
     */
    public function connectToMySQL($params)
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
     * @throws InvalidArgumentException データベース接続が確立されていない場合にスローします。
     *
     * @return mixed
     */
    public function getModelInstance($modelName)
    {

        //TODO: mysql接続情報をコンストラクタで受け取るようにしたら例外処理は不要になる想定。
        if ($this->dbh === null) {
            throw new InvalidArgumentException('データベース接続が確立されていません。');
        }

            $this->models[$modelName] = new $modelName($this->dbh);
            return $this->models[$modelName];

    }
}
