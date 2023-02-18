<?php

namespace App\Modules\Email\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class EmailResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'variables' => $this->variables,
            'code' => $this->code,
            'descriptions' => EmailTemplateResource::collection($this->templates->keyBy('language_code'))
        ];
    }
}
