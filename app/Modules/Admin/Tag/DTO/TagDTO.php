<?php

namespace App\Modules\Admin\Tag\DTO;

class TagDTO
{
    public function __construct(
        public ?int $id,
        public ?array $translations,
        public ?int $countryId,
        public ?int $languageId,
    )
    {
    }
}
