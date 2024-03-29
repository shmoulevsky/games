<?php

namespace App\Modules\Admin\Game\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class GameCategoryCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => GameCategoryShortResource::collection($this->collection),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
