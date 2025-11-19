<?php

namespace src\app\services;

use Exception;
use src\app\database\entities\User;
use src\app\database\Querio;
use src\support\Notification;

class UserService
{

    /**
     * create a user
     * Validations: email is unique
     * @param array $data - array with index to base user
     * @return array|bool
     */
    function create(array $data): array|bool
    {
        try {
            $user_by_email = User::selectOne(['*'])->where("email", "=", "{$data["email"]}")->finish();

            if ($user_by_email) {
                notification()->warning("O e-mail informado já está em uso");
                return false;
            }


            return User::create($data);
        } catch (Exception $e) {
            return false;
        }
    }
}
