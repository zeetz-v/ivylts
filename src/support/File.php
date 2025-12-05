<?php
namespace src\support;


class File
{

    static function csv(array $data)
    {
        $name_generate = time() . uniqid() . ".csv";
        $filename = path()->server("/csv/{$name_generate}");
        $filename = str_replace($_ENV["APP_DIR"], $_ENV["APP_DIR"] . "-storage", $filename);
        $file = fopen($filename, "w");
        foreach ($data as $row) {
            fputcsv($file, $row, ';');
        }
        fclose($file);
        return path()->storage("csv/{$name_generate}");
    }

    /**
     * Lista os arquivos do diretório informado via parâmetro
     * @param string $dir
     * @return array|bool
     */
    static function scan(string $dir): array|bool
    {
        $files = scandir(path()->storage_server($dir));
        $files = array_map(function ($file) {
            if ($file !== '.' && $file !== '..') {
                $server = path()->storage_server("csv/{$file}");
                return [
                    "file_name" => $file,
                    "file_server" => $server,
                    "file_link" => path()->storage("csv/{$file}"),
                    "created_at" => date("Y-m-d H:i:s", filectime($server)),
                    "access_at" => date("Y-m-d H:i:s", fileatime($server)),
                ];
            }
            return false;
        }, $files);
        return array_reverse(array_filter($files));
    }
}

?>