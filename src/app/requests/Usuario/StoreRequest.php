<?php
namespace src\app\requests\Usuario;

use src\app\requests\Request;

class StoreRequest extends Request
{
    public function __construct()
    {
        $this->execute();
    }

    protected array $rules = [
        "matricula" => 'nullable',
        "nome" => 'nullable',
        "area" => 'nullable',
        "email" => 'nullable',
        "role" => 'nullable',
        "senha" => 'nullable',
        "status" => 'nullable',
        "projeto_pend" => 'nullable',
    ];
}