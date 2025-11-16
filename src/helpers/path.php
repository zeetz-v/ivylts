<?php

function path()
{
    return new class() {
        function images(string $path)
        {
            if ($path[0] === '/')
                $path = mb_substr($path, 1);
            return $_ENV['APP_URL'] . "/public/images/{$path}";
        }

        function js(string $path)
        {
            if ($path[0] !== '/')
                $path = "/{$path}";
            return $_ENV['APP_URL']  . "/public/js{$path}";
        }

        function css(string $path)
        {
            if ($path[0] !== '/')
                $path = "/{$path}";
            return $_ENV['APP_URL'] . "/public/css{$path}";
        }
    };
}
