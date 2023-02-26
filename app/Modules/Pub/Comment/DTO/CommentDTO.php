<?php

namespace App\Modules\Pub\Comment\DTO;

class CommentDTO
{

    public function __construct(
        public ?string $name,
        public ?string $email,
        public ?string $comment,
        public ?int $userId,
        public ?int $entityId,
        public ?string $entityType,
        public ?int $countryId,
        public ?int $languageId,
    )
    {

    }
}
