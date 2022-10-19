<?php

namespace App\Modules\Common\Country\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CountryShortCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return  CountryShortResource::collection($this->collection);
    }
}
