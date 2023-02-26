<?php

namespace App\Modules\Pub\Comment\Repositories;

use App\Modules\Common\Base\Repositories\BaseRepository;
use App\Modules\Common\Comment\Models\Comment;

class CommentRepository extends BaseRepository
{
    protected $modelClass = Comment::class;

    public function getByEntity(
        int $entityId,
        string $entityType,
    )
    {
        $builder = $this->model
            ->select(
                'comments.id as id',
                'comments.comment as comment',
                'comments.created_at as created_at',
                'comments.name as name',
                'comments.email as email',
                'users.name as user_name',
                'users.photo as user_photo',
                'users.email as user_email',
            )->join('users', function ($query) {
                $query->on('users.id','=', 'comments.user_id');
            })->where([
                ['is_moderated', 1],
                ['entity_id', $entityId],
                ['entity_type', $entityType],
            ]);

        return $builder->orderBy('created_at')->get();
    }


}
