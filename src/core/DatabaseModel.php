<?php

class DatabaseModel
{
    protected $dbh;

    public function __construct($dbh)
    {
        $this->dbh = $dbh;
    }

    public function fetchAssoc($sql)
    {
        $result = $this->dbh->query($sql);
        return $result->fetch(PDO::FETCH_ASSOC);
    }
}
