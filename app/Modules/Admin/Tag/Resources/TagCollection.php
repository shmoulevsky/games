<?php

namespace App\Modules\Admin\Tag\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TagCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => TagShortResource::collection($this->collection),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
