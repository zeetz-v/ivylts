<?php

namespace src\app\middlewares;


class ifNotLoggedReditectToLoginMiddleware
{
    function execute(string $uri): void
    {
        if (!user()) 
            redirect()->uri(path()->get_host())->make();
    }
}
