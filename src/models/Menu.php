<?php

class Menu extends DatabaseModel
{
    public function fetchAssocUdon()
    {
        return $this->fetchAssoc('SELECT name FROM menus WHERE category_id = 1 ORDER BY RAND() LIMIT 1');
    }

    public function fetchAssocTempura()
    {
        return $this->fetchAssoc('SELECT name FROM menus WHERE category_id = 2 ORDER BY RAND() LIMIT 1');
    }
}
