<?php

namespace src\app\controllers;


use src\app\database\entities\Session;
use src\app\database\entities\Skope;
use src\exceptions\app\NotFoundSessionException;
use src\exceptions\app\NotFoundWithUuidException;
use src\exceptions\app\SessionInProgressException;
use src\support\Rules;
use src\support\View;

class SessionController
{

    public function __construct()
    {
    }

    /**
     * Inicia uma sessão de escopo para um usuário.
     *
     * @param string $uuid O identificador único do escopo (Skope) a ser iniciado.
     *
     * @return View A view "sessions.start" com os dados do escopo e da sessão.
     *
     * @throws NotFoundWithUuidException Lançada quando o escopo com o UUID fornecido não existe.
     * @throws SessionInProgressException Lançada quando já existe uma sessão em andamento para o escopo.
     *
     */
    public function start(string $uuid)
    {
        $skp = Skope::getByUuid($uuid) ?? throw new NotFoundWithUuidException();
        $session = Session::start($skp->id) ?? throw new SessionInProgressException(["data" => $skp]);
        Session::join(
            $session->id,
            user()->matricula,
            user()->nome,
            Rules::HOST
        );

        return view("sessions.start", ["skope" => $skp, "session" => $session]);
    }



    /**
     * Adiciona um usuário a uma sessão pelo UUID do projeto.
     *
     * Este método recupera um projeto (Skope) pelo seu UUID, verifica se existe uma sessão
     * para esse projeto, adiciona o usuário atual como participante se ainda não estiver na sessão,
     * e retorna a view da sala de espera.
     *
     * @param string $uuid O identificador único do projeto (Skope)
     *
     * @return View A view da sala de espera com dados do projeto e da sessão
     *
     * @throws NotFoundWithUuidException Se o UUID do projeto não existir
     * @throws NotFoundSessionException Se nenhuma sessão existir para o projeto
     *
     */
    public function join(string $uuid)
    {
        $skp = Skope::getByUuid($uuid)
        ?? throw new NotFoundWithUuidException();
        $session = Session::by_project_id($skp->id)
        ?? throw new NotFoundSessionException(["data" => $skp]);
        $user = user();


        if (!Session::is_participant_in_session($session->id, $user->matricula))
            Session::join(
                $session->id,
                $user->matricula,
                $user->nome,
                Rules::PARTICIPANT
            );

        return view("sessions.waiting", ["skope" => $skp, "session" => $session]);
    }
}
