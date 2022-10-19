<?php

namespace App\Modules\Common\Country\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'domain' => $this->domain,
            'name' => $this->name,
            'iso' => $this->iso,
            'sort' => $this->sort,
            'info' => json_decode($this->info),
            'is_active' => $this->is_active,
            'languages' => $this->languages->pluck('code'),
        ];
    }
}
