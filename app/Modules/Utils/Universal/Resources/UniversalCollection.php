<?php

namespace App\Modules\Utils\Universal\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UniversalCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
