<?php

namespace App\Modules\Game\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class GameCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => GameResource::collection($this->collection),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
