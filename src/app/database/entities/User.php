<?php

namespace src\app\database\entities;

use src\app\database\Querio;
use PDO;
use Exception;
use src\app\database\Database;
use src\exceptions\pdo\IsEmptyException;

class User extends Querio
{
    protected static string $table = 'users';
    protected static string $dbType = 'intranet';

    public static function findSeniorByMatricula($matricula)
    {

        if (!$matricula)
            throw new IsEmptyException();

        $db = Database::get('senior');
        try {
            $sql = "SELECT f.numcad as matricula, f.nomfun as nome, c.nomccu as area, e.emacom AS email
            FROM senior.R034fun f
            LEFT JOIN senior.R018ccu c ON c.codccu = f.codccu
            LEFT JOIN senior.r034cpl e on e.numcad = f.numcad 
            WHERE f.numcad = :matricula";
            $stmt = $db->prepare($sql);
            $stmt->execute(['matricula' => $matricula]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return false;
        }
    }



    static function persist(array $data)
    {
        try {
            $data['senha'] = "gbmx10";
            return self::create($data);
        } catch (Exception $e) {
            return "false";
        }
    }


}
