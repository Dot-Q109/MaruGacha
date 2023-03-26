<?php

/**
 * Menusテーブルからメニューをランダムに取得します。
 */
class Menu extends DatabaseModel
{

    /**
     * うどんをランダムに1品取得します。
     *
     * @return array{'name':string} うどんの情報
     */
    public function fetchAssocUdon()
    {
        return $this->fetchAssoc('SELECT name FROM menus WHERE category_id = 1 ORDER BY RAND() LIMIT 1');
    }

    /**
     * 天ぷらをランダムに1品取得します。
     *
     * @return array{'name':string} 天ぷらの情報
     */
    public function fetchAssocTempura()
    {
        return $this->fetchAssoc('SELECT name FROM menus WHERE category_id = 2 ORDER BY RAND() LIMIT 1');
    }
}
