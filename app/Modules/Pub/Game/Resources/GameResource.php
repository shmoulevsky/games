<?php

namespace App\Modules\Pub\Game\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GameResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'thumb' => $this->thumb,
            'description' => $this->description,
            'rules' => $this->rules,
            'game' => $this->game,
            'date' => $this->date,
        ];
    }
}
