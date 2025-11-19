<?php
namespace src\app\controllers;

use src\app\database\entities\User;
use src\app\requests\Users\StoreRequest;
use src\app\services\UserService;
use src\support\Redirect;
use src\support\View;

class HelloController
{
    function __construct(
        private UserService $user_service,
    ) {
    }


    function hello(): View
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
            return backError('Não foi possível criar o usuário');
        return backSuccess('O usuário foi criado com sucesso');
    }
}