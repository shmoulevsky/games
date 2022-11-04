<?php

namespace App\Modules\Admin\Game\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GameShortResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'translations' => $this->translations(),
        ];
    }
}
