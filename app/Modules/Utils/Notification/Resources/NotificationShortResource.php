<?php

namespace App\Modules\Utils\Notification\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationShortResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'sort' => $this->sort,
            'is_active' => $this->is_active,
            'name' => $this->description ?? '-'
        ];
    }
}
