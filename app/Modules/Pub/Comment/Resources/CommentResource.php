<?php

namespace App\Modules\Pub\Comment\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name ?? $this->user_name,
            'photo' => $this->user_photo,
            'comment' => $this->comment,
            'date' => $this->created_at->format('d.m.Y'),
            'time' => $this->created_at->format('H:i:s'),
        ];
    }
}
