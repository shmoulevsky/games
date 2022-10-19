<?php

namespace App\Modules\Language\Resources;

use App\Modules\Common\Language\Services\LanguageService;
use App\Modules\Setting\Models\Settings;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class LanguageGroupResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->translation,
            'code' => $this->code,
        ];
    }
}
