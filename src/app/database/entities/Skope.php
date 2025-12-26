<?php

namespace src\app\database\entities;

use src\app\database\Querio;
use src\support\Status;

class Skope extends Querio
{
    protected static string $table = 'bd_amsted.projects';
    protected static string $dbType = 'intranet';

    public string $uuid;
    public int $id;
    public string $request;
    public ?string $title;
    public ?string $requester;
    public ?string $analyst;
    public ?string $company;
    public ?string $developer;
    public ?string $begin;
    public ?string $end;
    public ?string $quick_win;
    public ?string $type_project;
    public ?string $status;
    public string $created_at;
    public string $updated_at;


    /**
     * Verifica se o projeto está no status de estimado
     * 
     * Determina se o status atual do projeto corresponde ao status WITH_DEVS,
     * indicando que o projeto está com os desenvolvedores para estimativa.
     * 
     * @return bool Retorna true se o status for WITH_DEVS, false caso contrário
     */
    function is_estimated(): bool
    {
        return $this->status === Status::WITH_DEVS;
    }


    function waiting(): bool
    {
        return $this->get_in_status(Status::WAITING_DEVS);
    }

    function in_session(): bool
    {
        return $this->get_in_status(Status::IN_SESSION);
    }

    function not_in_session(): bool
    {
        return $this->get_in_status(Status::NOT_IN_SESSION);
    }

    function get_in_status(string $status): bool
    {
        $session = Session::get_by_project_id($this->id);
        if (!$session)
            return false;
        return $session->status === $status;
    }

    /**
     * Busca todos os projetos com status específicos
     * 
     * Retorna uma lista de projetos que estão com os desenvolvedores (WITH_DEVS)
     * ou que já foram estimados (WITH_ESTIMATED), ordenados por status em ordem
     * decrescente.
     * 
     * @return array|bool Lista de projetos
     */
    static function get(): array|bool
    {
        return self::select()->whereIn("status", [Status::WITH_DEVS, Status::WITH_ESTIMATED])->order("status", "DESC")->finish();
    }
}
