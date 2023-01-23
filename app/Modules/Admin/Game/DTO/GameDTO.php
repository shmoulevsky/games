<?php

namespace App\Modules\Admin\Game\DTO;

class GameDTO
{
    public function __construct(
        public ?int $id,
        public ?string $game,
        public ?string $thumb,
        public ?int $categoryId,
        public ?array $translations,
        public ?int $countryId,
        public ?int $languageId,
    )
    {
    }
}
