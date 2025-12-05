<?php
namespace src\app\controllers;

use src\app\database\entities\Checkin;
use src\app\requests\StoreRequest;
use src\app\services\CheckinService;
use src\app\services\GenService;
use src\support\File;
use src\support\Redirect;
use src\support\Request;
use src\support\Sessions;
use src\support\View;

class CheckinController
{
    function __construct(
        private CheckinService $checkin_service,
    ) {
    }

    /**
     * Exibe o formulário de filtros que o usuário irá selecionar
     * Após submter o form, irá disparar um post para o método csv() deste controller.
     * @return View
     */
    function read(): View
    {

        $key = Request::query_params("key");
        $deps = null;
        $collaborator = null;
        $checkin = null;


        if ($key) {
            $collaborator = $this->checkin_service->get_collaborator($key);
            $deps = $this->checkin_service->get_deps($key);
            $deps = array_filter(array_merge([["nomdep" => $collaborator['nome']]], $deps), fn($d) => !empty($d["nomdep"]));
        }


        if ($collaborator && $collaborator["matricula"]) {
            $checkin = $this->checkin_service->get_by_matricula($collaborator["matricula"]);
            if ($checkin) {
                notification()->warning("Este colaborador já registrou a entrada");
            }
        }



        return view("read", [
            "deps" => $deps,
            "collaborator" => $collaborator,
            "checkin" => $checkin
        ]);
    }


    function checkin()
    {
        $data = $_POST;
        $this->checkin_service->delete($data);
        $this->checkin_service->create($data);

        return redirect()->route("read", [], ["not-validate" => 1])->withSuccess("Check-in registrado com sucesso 🎉");
    }




    function details()
    {
        $checkins = Checkin::getAll();
        $contagem = ["presentes" => ["list" => [], "total" => 0], "ausentes" => ["list" => [], "total" => 0]];
        foreach ($checkins as $checkin_idx => $checkin) {
            $presentes = array_filter(explode(';', $checkin->presentes));
            $ausentes = array_filter(explode(';', $checkin->ausentes));
            $contagem["presentes"]["list"] = array_merge($contagem["presentes"]["list"], $presentes);
            $contagem["ausentes"]["list"] = array_merge($contagem["ausentes"]["list"], $ausentes);
            $contagem["presentes"]["total"] += count($presentes);
            $contagem["ausentes"]["total"] += count($ausentes);
        }

        return view("details", ["details" => $contagem]);
    }

}