<?php

namespace App\Modules\Email\DTO;

class EmailDTO
{
    public $id;
    public $code;
    public $variables;
    public $templates;

    public function __construct(
        ?int    $id,
        string $code,
        string $variables,
        array  $templates
    ){
        $this->templates = $templates;
        $this->variables = $variables;
        $this->code = $code;
        $this->id = $id;
    }
}
