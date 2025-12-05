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


        function storage(string $path = "")
        {
            $link = str_replace($_ENV["APP_DIR"], $_ENV["APP_DIR"] . "-storage", $this->start_path() . "/{$path}");
            return $link;
        }

        function storage_server(string|null $complement = null)
        {
            return getcwd() . "-storage/" . $complement;
        }


        function start_path(string $complement = '')
        {
            $r = !is_remote() ? path()->get_host() : path()->get_host() . '/' . str_replace('/var/www/htdocs/', "", getcwd());
            if (empty($complement))
                return $r;
            return $r . $complement;
        }



        function server(string|null $complement = null)
        {
            return getcwd() . $complement;
        }


        function get_url()
        {
            if (is_remote()) {
                $getcwd = array_filter(
                    explode('/', getcwd()),
                    fn($i) => !in_array($i, ['', 'var', 'www', 'html', 'htdocs'])
                );
                $getcwdCleaned = implode("/", $getcwd);
                $url = path()->get_host() . "/{$getcwdCleaned}";
                return $url;
            } else {
                $getcwd = array_values(array_filter(
                    explode('/', $_SERVER["REDIRECT_URL"]),
                    fn($i) => !in_array($i, ['', 'var', 'www', 'html', 'htdocs'])
                ));
                $getcwdCleaned = implode("/", [$getcwd[0], $getcwd[1], $getcwd[2]]);
                $url = path()->get_host() . "/{$getcwdCleaned}";
                return $url;
            }
        }

        function get_company()
        {
            if (is_remote()) {
                $getcwd = array_values(
                    array_filter(
                        explode('/', getcwd()),
                        fn($i) => !in_array($i, ['', 'var', 'www', 'html', 'htdocs'])
                    )
                );
                return $getcwd[0];
            } else {
                $path = array_values(array_filter(explode('/', $_SERVER["REDIRECT_URL"])));
                return $path[0];
            }
        }


        function get_host()
        {
            $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
                ? "https://"
                : "http://";
            return $protocol . $_SERVER['HTTP_HOST'];
        }
    };
}
