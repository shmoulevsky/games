<?php

namespace App\Modules\Admin\Game\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GameResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'sort' => $this->sort,
            'is_active' => $this->is_active,
            'game' => $this->game,
            'translations' => $this->translations->keyBy('language_id'),
        ];
    }
}
