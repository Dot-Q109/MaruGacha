<?php

/**
 * Menusテーブルから、メニューをランダムに取得するクラスです。
 */
class Menu extends DatabaseModel
{

    /**
     * うどんをランダムに1品取得します。
     *
     * @return array{'name':string} 取得したうどん名
     */
    public function fetchAssocUdon()
    {
        return $this->fetchAssoc('SELECT name FROM menus WHERE category_id = 1 ORDER BY RAND() LIMIT 1');
    }

    /**
     * 天ぷらをランダムに1品取得します。
     *
     * @return array{'name':string} 取得した天ぷら名
     */
    public function fetchAssocTempura()
    {
        return $this->fetchAssoc('SELECT name FROM menus WHERE category_id = 2 ORDER BY RAND() LIMIT 1');
    }
}
