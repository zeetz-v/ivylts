<?php
namespace src\app\controllers;

use src\app\database\entities\User;
use src\app\requests\Users\StoreRequest;
use src\app\requests\Users\UpdateRequest;
use src\app\services\UserService;
use src\exceptions\app\NotFoundWithUuidException;
use src\support\Redirect;
use src\support\View;

class UserController
{
    function __construct(
        private UserService $user_service,
    ) {
    }


    /**
     * List users
     * @return View
     */
    function list(): View
    {
        $users = User::getAll();
        return view('users.list', ['users' => $users]);
    }


    /**
     * Store a user
     * @param StoreRequest $request
     * @return Redirect
     */
    function store(StoreRequest $request): Redirect
    {
        $user = $this->user_service->create($request->get());
        if (!$user)
            return backError('Não foi possível criar o usuário.');
        return backSuccess('O usuário foi criado com sucesso');
    }


    /**
     * Edit user
     * @param string $uuid
     * @throws NotFoundWithUuidException
     * @return View
     */
    function edit(string $uuid): View
    {
        $user = User::getByUuid($uuid);
        if (!$user)
            throw new NotFoundWithUuidException;
        return view('users.edit', ['u' => $user]);
    }


    /**
     * Update a user
     * @param UpdateRequest $request
     * @return Redirect
     */
    function update(UpdateRequest $request, string $uuid)
    {
        $user = User::getByUuid($uuid);
        if (!$user)
            throw new NotFoundWithUuidException(['uuid' => $uuid]);

        return !$this->user_service->update($request->get()) ?
            backError('Não foi possível atualizar os dados') :
            backSuccess('Os dados do usuário foram atualizados com sucesso 🎉');
    }



    function delete()
    {
        return backSuccess("Usuário excluído com sucesso");
    }
}