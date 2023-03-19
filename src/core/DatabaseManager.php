<?php

class DatabaseManager
{
    protected $dbh;
    protected $models;

    public function connect($params)
    {
        try{
            $dsn = "mysql:dbname={$params['database']};host={$params['hostname']};";
            $user = $params['username'];
            $password =$params['password'];

            $this->dbh = new PDO($dsn,$user,$password);
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function get($modelName)
    {
        $model = new $modelName($this->dbh);
        $this->models[$modelName] = $model;

        return $this->models[$modelName];
    }
}
