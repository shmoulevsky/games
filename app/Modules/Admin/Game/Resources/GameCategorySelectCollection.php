<?php

namespace App\Modules\Admin\Game\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class GameCategorySelectCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => GameCategorySelectResource::collection($this->collection),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
