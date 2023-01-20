<?php

namespace App\Modules\Admin\Game\DTO;

class GameCategoryDTO
{
    public function __construct(
        public ?int $id,
        public ?string $parentId,
        public ?string $thumb,
        public ?array $translations,
        public ?int $countryId,
        public ?int $languageId,
    )
    {
    }
}
