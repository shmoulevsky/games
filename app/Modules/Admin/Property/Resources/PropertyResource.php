<?php

namespace App\Modules\Admin\Property\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PropertyResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'is_show_list' => (bool)$this->is_show_list,
            'is_show_form' => (bool)$this->is_show_form,
            'translations' => $this->translations->keyBy('language_id'),
        ];
    }
}
