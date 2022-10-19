<?php

namespace App\Modules\Common\User\Common\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserShortResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name ?? '-',
            'lastname' => $this->last_name ?? '-',
            'email' => $this->email,
            'phone' => $this->phone ?? '-',
            'phone_verified_at' => $this->phone_verified_at,
            'status' => $this->status,
            'created_at' => $this->date,
        ];
    }
}
