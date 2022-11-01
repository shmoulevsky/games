<?php

namespace App\Modules\Game\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GameResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'translations' => $this->translations()->keyBy('id'),
        ];
    }
}
