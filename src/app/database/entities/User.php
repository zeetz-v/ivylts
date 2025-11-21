<?php

namespace src\app\database\entities;

use src\app\database\Querio;


class User extends Querio
{
    protected static string $table = 'users';
    protected static string $dbType = 'intranet';
}
