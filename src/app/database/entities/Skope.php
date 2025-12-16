<?php

namespace src\app\database\entities;

use src\app\database\Querio;


class Skope extends Querio
{
    protected static string $table = 'skopes';
    protected static string $dbType = 'intranet';

    public string $uuid;
    public int $id;
    public string $request;
    public string $title;
    public string $requester;
    public string $analyst;
    public string $company;
    public string $developer;
    public string $begin;
    public string $end;
    public string $quick_win;
    public string $type_project;
    public string $status;
    public string $created_at;
    public string $updated_at;


    function is_estimated(): bool
    {
        return $this->status === "estimado";
    }
}
