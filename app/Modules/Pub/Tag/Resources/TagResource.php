<?php

namespace App\Modules\Pub\Tag\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TagResource extends JsonResource
{
    public function toArray($request)
    {
        $url = urldecode($request->url);

        return [
            'id' => $this->tag_id,
            'title' => $this->tag,
            'url' => $this->url,
            'selected' => $this->url === $url,
        ];
    }
}
