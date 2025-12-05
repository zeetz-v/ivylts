<?php
namespace src\app\requests;


class StoreRequest extends Request
{

    protected array $rules = [
        "date_emission" => "required",
        "supplier_code" => "required",
        "nf_number" => "required",
    ];

}
?>