<?php

namespace App\Modules\Admin\Property\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PropertyCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => PropertyShortResource::collection($this->collection),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
