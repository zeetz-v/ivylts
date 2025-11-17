<?php
namespace src\app\controllers;

use src\app\database\entities\User;

class HelloController
{
    function __construct()
    {
    }


    function hello()
    {
        $users = User::getAll();
        return view('users.list', ['users'=> $users]);
    }
}