<?php

namespace src\app\database\entities;

use PDO;
use src\app\database\Querio;

class Danfe extends Querio
{
    protected static string $table = 'conteudo_intranet';
    protected static string $dbType = 'informix';
}
