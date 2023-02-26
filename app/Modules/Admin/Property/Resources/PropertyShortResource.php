<?php

namespace App\Modules\Admin\Property\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PropertyShortResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
        ];
    }
}
