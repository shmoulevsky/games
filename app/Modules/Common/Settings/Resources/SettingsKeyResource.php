<?php

namespace App\Modules\Common\Settings\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SettingsKeyResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'json' => json_decode($this->json),
        ];
    }
}
