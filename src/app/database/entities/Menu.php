<?php

namespace src\app\database\entities;

use PDO;
use src\app\database\Querio;

class Menu extends Querio
{
    protected static string $table = '';
    protected static string $dbType = 'intranet';


    /**
     * Busca um menu de acordo com o Id
     * @param int $id
     * @return bool|object|array
     */
    static function getByMenuId(int $id): array|bool|object
    {
        return self::selectOne(['*'])->whereEquals('menuId', $id)->finish();
    }

    /**
     * Bysca todos os menus pais
     * @return bool|object|array
     */
    static function getBreadcrumbs(): bool|object|array
    {
        return self::select(['*'])->whereEquals('menuLink', '#')->finish();
    }
}
