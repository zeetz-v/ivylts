<?php
namespace src\app\requests\Usuario;

use src\app\requests\Request;

class UpdateRequest extends Request
{
    public function __construct()
    {
        $this->execute();
    }

    protected array $rules = [
        "matricula" => 'nullable',
        "role" => 'nullable',
        "senha" => 'nullable',
        "status" => 'nullable',
       
    ];
}