<?php

namespace App\Modules\Admin\Game\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GameResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'game' => $this->game,
            'thumb' => $this->thumb,
            'category_id' => $this->category_id,
            'translations' => $this->translations->keyBy('language_id'),
        ];
    }
}
