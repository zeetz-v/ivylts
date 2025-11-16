<?php

namespace src\app\database\entities;

use PDO;
use src\app\database\Querio;

class Feedback extends Querio
{
    protected static string $table = 'tb_food_feedback';
    protected static string $dbType = 'casa';
}
