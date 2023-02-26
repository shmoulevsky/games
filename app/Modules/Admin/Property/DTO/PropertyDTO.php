<?php

namespace App\Modules\Admin\Property\DTO;

class PropertyDTO
{
    public function __construct(
        public ?int $id,
        public ?int $isShowList,
        public ?int $isShowForm,
        public ?array $translations,
    )
    {
    }
}
