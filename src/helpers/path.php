<?php

function path()
{
    return new class () {
        function images(string $path)
        {
            if ($path[0] === '/')
                $path = mb_substr($path, 1);
            return $this->start_path() . "/public/images/{$path}";
        }

        function js(string $path)
        {
            if ($path[0] !== '/')
                $path = "/{$path}";
            return $this->start_path() . "/public/js{$path}";
        }

        function css(string $path)
        {
            if ($path[0] !== '/')
                $path = "/{$path}";
            return $this->start_path() . "/public/css{$path}";
        }


        function start_path()
        {
            return $_ENV["APP_ENVIRONMENT"] . '/' . str_replace("/var/www/htdocs/", "", getcwd());
        }
    };
}
