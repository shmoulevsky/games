<?php

namespace App\Modules\Admin\Game\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GameCategorySelectResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'value' => $this->id,
            'text' => $this->title,
        ];
    }
}
