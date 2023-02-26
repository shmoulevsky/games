<?php

namespace App\Modules\Pub\Comment\Services;

use App\Modules\Common\Comment\Models\Comment;
use App\Modules\Pub\Comment\DTO\CommentDTO;

class CommentService
{
    public function store(CommentDTO $dto)
    {
        $comment = new Comment();
        $comment->name = $dto->name;
        $comment->email = $dto->email;
        $comment->comment = $dto->comment;
        $comment->language_id = $dto->languageId;
        $comment->country_id = $dto->countryId;
        $comment->user_id = $dto->userId;
        $comment->entity_id = $dto->entityId;
        $comment->entity_type = $dto->entityType;
        $comment->save();

        return $comment;
    }
}
