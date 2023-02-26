<?php

namespace App\Modules\Admin\Property\Repositories;

use App\Modules\Common\Base\Repositories\BaseRepository;
use App\Modules\Common\Property\Models\PropertyTranslation;

class PropertyTranslationRepository extends BaseRepository
{
    protected $modelClass = PropertyTranslation::class;

    public function find(string $languageId, int $propertyId)
    {
        return $this->model->where([
            ['language_id', $languageId],
            ['property_id', $propertyId],
        ])->first();
    }

}
