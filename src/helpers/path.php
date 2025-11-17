<?php

function path()
{
    return new class () {
        function images(string $path)
        {
            if ($path[0] === '/')
                $path = mb_substr($path, 1);
            return "/public/images/{$path}";
        }

        function js(string $path)
        {
            if ($path[0] !== '/')
                $path = "/{$path}";
            return "/public/js{$path}";
        }

        function css(string $path)
        {
            if ($path[0] !== '/')
                $path = "/{$path}";
            return "/public/css{$path}";
        }
    };
}
