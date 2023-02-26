<?php

namespace App\Modules\Admin\Property\Services;


use App\Modules\Admin\Property\DTO\PropertyDTO;
use App\Modules\Admin\Property\Repositories\PropertyRepository;
use App\Modules\Admin\Property\Repositories\PropertyTranslationRepository;
use App\Modules\Common\Base\Services\BaseTranslationService;
use App\Modules\Common\Property\Models\Property;
use App\Modules\Common\Property\Models\PropertyTranslation;

class PropertyService extends BaseTranslationService
{
    protected $modelClass = Property::class;
    protected $repositoryClass = PropertyRepository::class;
    protected string $modelTranslationClass = PropertyTranslation::class;
    protected string $repositoryTranslationClass = PropertyTranslationRepository::class;
    protected string $linkProperty = 'property_id';

    public function createOrUpdate(PropertyDTO $dto)
    {
        $property = $this->getItem($dto->id);
        $property->is_show_list = $dto->isShowList ?? 0;
        $property->is_show_form = $dto->isShowForm ?? 0;
        $property->save();
        $this->storeTranslations($dto->translations, $property);
        return $property;
    }
}
