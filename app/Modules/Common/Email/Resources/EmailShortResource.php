<?php

namespace App\Modules\Email\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmailShortResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this['id'],
            'title' => $this->templates->first()->title ?? '-',
        ];
    }
}
