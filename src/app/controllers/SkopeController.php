<?php

namespace src\app\controllers;

use src\app\services\UserService;
use src\support\View;

class SkopeController
{
    /**
     * Constructor do SkopeController
     * 
     * Inicializa o controller com as dependências necessárias através de injeção de dependência.
     * 
     * @param UserService $user_service Serviço responsável pela gestão de usuários
     */
    function __construct(
        private UserService $user_service,
    ) {}

    /**
     * Exibe a listagem de escopos (skopes)
     * 
     * Este método retorna uma view com a lista de escopos disponíveis.
     * Caso não existam escopos, exibe uma notificação de sucesso e retorna
     * uma view vazia específica.
     * 
     * @return View Retorna a view 'skopes.index' com a lista de escopos ou 'skopes.empty' se não houver escopos
     */
    function index()
    {
        $skopes = [
            [
                "id" => "0001",
                "title" => "Projeto para automatização...",
                "analyst" => "Diego Donizete",
                "developer" => "José Jesus",
                "ticket" => "https://google.com",
                "status" => "aguardando"
            ],
            [
                "id" => "0002",
                "title" => "Desenvolvimento de CRUD para gerenciamento...",
                "analyst" => "Denise Fernandes",
                "developer" => "José Jesus",
                "ticket" => "https://google.com",
                "status" => "aguardando"
            ],
            [
                "id" => "0003",
                "title" => "Desenvolvimento de ETL de Compras",
                "analyst" => "Tayna Santos",
                "developer" => "José Jesus",
                "ticket" => "https://google.com",
                "status" => "estimado"
            ],
            [
                "id" => "0003",
                "title" => "Desenvolvimento de ETL de Compras",
                "analyst" => "Tayna Santos",
                "developer" => "José Jesus",
                "ticket" => "https://google.com",
                "status" => "estimado"
            ],
            [
                "id" => "0003",
                "title" => "Desenvolvimento de ETL de Compras",
                "analyst" => "Tayna Santos",
                "developer" => "José Jesus",
                "ticket" => "https://google.com",
                "status" => "estimado"
            ],
            [
                "id" => "0003",
                "title" => "Desenvolvimento de ETL de Compras",
                "analyst" => "Tayna Santos",
                "developer" => "José Jesus",
                "ticket" => "https://google.com",
                "status" => "estimado"
            ],
            [
                "id" => "0003",
                "title" => "Desenvolvimento de ETL de Compras",
                "analyst" => "Tayna Santos",
                "developer" => "José Jesus",
                "ticket" => "https://google.com",
                "status" => "estimado"
            ],
            [
                "id" => "0003",
                "title" => "Desenvolvimento de ETL de Compras",
                "analyst" => "Tayna Santos",
                "developer" => "José Jesus",
                "ticket" => "https://google.com",
                "status" => "estimado"
            ]
        ];
        // $skopes = [];
        if (empty($skopes)) {
            notification()->success("Não há nenhum escopo disponível para hoje 🎉");
            return view("skopes.empty");
        }
        return view("skopes.index", ["skopes" => $skopes]);
    }
}
