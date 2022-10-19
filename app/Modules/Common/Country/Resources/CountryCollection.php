<?php

namespace App\Modules\Common\Country\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CountryCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => CountryResource::collection($this->collection),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
