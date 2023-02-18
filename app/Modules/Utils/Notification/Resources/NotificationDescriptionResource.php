<?php

namespace App\Modules\Utils\Notification\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationDescriptionResource extends JsonResource
{
    public function toArray($request)
    {
        return [
                'id' => $this->id,
                'name' => $this->name,
                'description' => $this->description
        ];
    }
}
