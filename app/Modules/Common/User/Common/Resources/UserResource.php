<?php

namespace App\Modules\Common\User\Common\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name ?? '',
            'lastname' => $this->lastname ?? '',
            'email' => $this->email,
            'phone' => $this->phone ?? '',
            'phone_verified_at' => $this->phone_verified_at,
            'status' => $this->status,
            'access_panel' => $this->access_panel,
            'group_id' => $this->group_id,
        ];
    }
}
