<?php

namespace App\Modules\Utils\Notification\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'sort' => $this->sort,
            'is_active' => $this->is_active,
            'interval' => $this->interval,
            'frequency' => $this->frequency,
            'delay' => $this->delay,
            'count' => $this->count,
            'channels' => $this->channels,
            'groups' => $this->groups,
            'typeId' => $this->type->id,
            'descriptions' => NotificationDescriptionResource::collection($this->descriptions->keyBy('language_code')),
        ];
    }
}
