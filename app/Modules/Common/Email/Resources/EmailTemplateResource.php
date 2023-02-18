<?php

namespace App\Modules\Email\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmailTemplateResource extends JsonResource
{
    public function toArray($request)
    {
        return [
                'id' => $this->id,
                'title' => $this->title,
                'template' => $this->template,
                ];
    }
}
