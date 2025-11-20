<?php

namespace src\app\services;

use src\app\database\entities\User;
use src\exceptions\app\EmailDuplicateException;

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
        if ($this->byEmail($data["email"]))
            throw new EmailDuplicateException;

        return User::create($data);
    }



    function byEmail(string $email)
    {
        return $user_by_email = User::selectOne(['*'])->where("email", "=", $email)->finish();
    }
}
