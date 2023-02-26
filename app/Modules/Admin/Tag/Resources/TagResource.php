<?php

namespace App\Modules\Admin\Tag\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TagResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'translations' => $this->translations->keyBy('language_id'),
        ];
    }
}
