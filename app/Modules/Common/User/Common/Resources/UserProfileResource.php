<?php

namespace App\Modules\Common\User\Common\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserProfileResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this['user']->id,
            'name' => $this['user']->name ?? '',
            'lastname' => $this['user']->lastname ?? '',
            'email' => $this['user']->email ?? '',
            'phone' => $this['user']->phone ?? '',
            'passport' => $this['user']->code ?? '',
            'status' => $this['user']->status,
        ];
    }
}
