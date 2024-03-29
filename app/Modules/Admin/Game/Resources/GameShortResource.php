<?php

namespace App\Modules\Admin\Game\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GameShortResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'created_at' => $this->created_at->format('d.m.Y, H:i:s'),
            'thumb' => $this->thumb,
            'url' => $this->url,
            'category' => $this->category_id,
        ];
    }
}
