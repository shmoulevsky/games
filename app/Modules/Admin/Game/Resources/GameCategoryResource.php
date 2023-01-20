<?php

namespace App\Modules\Admin\Game\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GameCategoryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'thumb' => $this->thumb,
            'translations' => $this->translations->keyBy('language_id'),
        ];
    }
}
