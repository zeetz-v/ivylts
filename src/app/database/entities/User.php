<?php

namespace src\app\database\entities;

use src\app\database\Querio;


class User extends Querio
{
    protected static string $table = 'bd_amsted.z_users';
    protected static string $dbType = 'intranet';
}
