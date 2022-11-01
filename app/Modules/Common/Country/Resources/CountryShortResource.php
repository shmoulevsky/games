<?php

namespace App\Modules\Common\Country\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CountryShortResource extends JsonResource
{
    public function toArray($request)
    {

        $host = str_ireplace('www.','', request()->getHost());

        return [
            'id' => $this->id,
            'iso' => $this->iso,
            'domain' => $this->domain,
            'name' => $this->name,
            'is_current' => $this->domain === $host,
            'languages' => $this->languages->makeHidden('pivot')
        ];
    }
}
