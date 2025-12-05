<?php

namespace src\app\database\entities;

use src\app\database\Querio;


class Checkin extends Querio
{
    protected static string $table = 'bd_amsted.ec_checkins';
    protected static string $dbType = 'intranet';
}
