<?php
namespace src\app\services;

use PDO;
use src\app\database\Database;
use src\app\database\entities\Checkin;
use src\support\Sessions;

class CheckinService
{
    function __construct()
    {
    }

    function get_mifare(string $key, string $column)
    {
        $db = Database::get('informix');
        $stmt = $db->prepare("SELECT * FROM mx_mifare WHERE {$column} = :key");
        $stmt->execute(["key" => $key]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    function get_collaborator(string $key)
    {
        $db = Database::get("senior");
        $matricula = $this->get_matricula_from_mx_mifare($key);
        $stmt = $db->prepare("SELECT nomfun FROM SENIOR.r034fun WHERE numcad = :matricula");
        $stmt->execute(["matricula" => $matricula]);
        $name = $stmt->fetch(PDO::FETCH_COLUMN);
        return ["matricula" => $matricula, "nome" => $name ?: null];
    }

    function get_deps(string $key)
    {
        $matricula = $this->get_matricula_from_mx_mifare($key);

        $db = Database::get("senior");
        $select = "SELECT a.numemp, d.nomloc, a.numcad, b.nomfun, a.coddep, a.nomdep, a.tipsex,(YEAR(GETDATE()) - YEAR(a.datnas)) idade FROM SENIOR.r036dep a, SENIOR.r034fun b, SENIOR.r016hie c, SENIOR.r016orn d, SENIOR.r164dep e WHERE a.numemp = 09 AND CONVERT(DATE, a.datexc) = CAST('1900-12-31' AS DATE) AND a.numemp = b.numemp AND a.tipcol = b.tipcol AND a.numcad = b.numcad AND b.sitafa NOT IN (3, 4, 70, 71, 73, 133, 74, 7) AND b.taborg = c.taborg AND b.numloc = c.numloc AND c.taborg = d.taborg AND c.numloc = d.numloc AND a.numemp = e.numemp AND a.tipcol = e.tipcol AND a.numcad = e.numcad AND a.coddep = e.coddep AND e.mesexc = CAST('1900-12-31' AS DATE) AND e.codoem IN (8) AND a.numcad = '{$matricula}' ORDER BY 1, 2, 3, 5";
        $stmt = $db->prepare($select);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }


    function get_matricula_from_mx_mifare(string $key)
    {
        $mifare = $this->get_mifare($key, "num_matricula");
        if (!$mifare)
            $mifare = $this->get_mifare($key, "cod_mifare");
        return $mifare["NUM_MATRICULA"] ?? null;
    }



    function create(array $data)
    {
        $presentes = array_filter($data["deps"], fn($yes_or_no) => $yes_or_no === "sim");
        $ausentes = array_filter($data["deps"], fn($yes_or_no) => $yes_or_no === "não");

        $presentesNomes = implode(';', array_keys($presentes));
        $ausenteNomes = implode(';', array_keys($ausentes));
        $data = ["collaborator" => $data["collaborator"], "presentes" => $presentesNomes, "ausentes" => $ausenteNomes];
        Checkin::create($data);
    }

    function delete(array $data)
    {
        $collaborator = $data["collaborator"];
        Checkin::delete()->whereEquals("collaborator", $collaborator)->finish();
    }

    function get_by_matricula(string $matricula)
    {
        return Checkin::selectOne(['*'])->whereEquals("collaborator", $matricula)->finish();
    }

}