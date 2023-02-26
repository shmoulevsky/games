<?php

namespace App\Modules\Admin\Tag\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TagShortResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'created_at' => $this->created_at->format('d.m.Y, H:i:s'),
            'url' => $this->url,
            'category' => $this->category_id,
        ];
    }
}
