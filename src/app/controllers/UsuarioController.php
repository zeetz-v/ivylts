<?php

namespace src\app\controllers;


use src\app\database\entities\Usuario;
use src\app\requests\Usuario\StoreRequest;
use src\app\requests\Usuario\UpdateRequest;
use src\support\Redirect;
use src\support\Request;
use src\support\View;
use src\support\Json;


class UsuarioController
{

    function cadastroUsuarioView(): View
    {
        return view('parametrizacao.usuario', [
            'usuarios' => Usuario::getAll()
        ]);
    }

    function consultaUsuario()
    {
        $matricula = Request::query('matricula');
        $userData = Usuario::findSeniorByMatricula($matricula);

        if (!$userData)
            return Json::return([
                "message" => "Usuário Não Encontrado",
                "data" => null
            ], 404);


        return Json::return([
            "message" => "Usuário Encontrado",
            "data" => $userData
        ], 200);
    }


    function storeUsuario(StoreRequest $request)
    {
        $user = Usuario::persist($request->get());
       
    
        if (!$user)
            return redirect()->route("parametrizacao.usuario")->withError("Não criado 🎉");

        return redirect()->route("parametrizacao.usuario")->withSuccess("Usuário cadastrado 🎉");
    }

    function updateUsuario(UpdateRequest $request)
    {
        $data2update = $request->get();
        Usuario::updateByUuid($data2update['id'], $data2update);
        return redirect()->route("parametrizacao.usuario")->withSuccess("Usuário atualizado 🎉");
    }


    /**
     * Exibe o formulário de edição/criação.
     *
     * @param string $id id que será exibida ou editada.
     *
     * @return View Retorna a view com os dados necessários.
     */
    function modalConfirm(string $id): View
    {
        $usuario = Usuario::getByUuid($id);
        return view('modals.confirmation', [
            "usuario" => $usuario
        ]);
    }

    /**
     * Exibe o formulário de edição/criação.
     *
     * @param string $id id que será exibida ou editada.
     *
     * @return View Retorna a view com os dados necessários.
     */
    function modalEdit(string $id): View
    {
        $usuario = Usuario::getByUuid($id);
        return view('modals.editUsuario', [
            "usuario" => $usuario
        ]);
    }

    /**
     * Exclui o menu de acordo com o id
     * @param string $id - id do lançamento
     *
     * @return Redirect - Redireciona para a tela de listagem de lançamentos
     */
    function deleteUsuario(string $id)
    {
        Usuario::deleteByUuid($id);
        return redirect()->route("parametrizacao.usuario")->withSuccess("Usuário deletado com sucesso🎉");
    }
}

