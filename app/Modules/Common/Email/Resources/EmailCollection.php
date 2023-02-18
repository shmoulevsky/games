<?php

namespace App\Modules\Email\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class EmailCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => EmailShortResource::collection($this->collection),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
