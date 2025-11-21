<?php

namespace src\exceptions\app;

use Exception;
use src\traits\LogException;

class NotFoundWithUuidException extends Exception
{
    private string $entity = 'app';

    use LogException;

    function __construct(array $content = [])
    {
        $message = 'O registro não foi encontrado';
        $code = 500;
        $this->log($message, $code, json_encode($content));
        return parent::__construct($message, $code);
    }
}
