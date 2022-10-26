<?php

namespace App\Modules\Utils\Generator\DTO;

class GeneratorTableSettingDTO
{
    public function __construct(
        public string $table,
        public ?array $list,
        public ?array $form,
    )
    {
    }
}
