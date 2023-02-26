<?php

namespace App\Modules\Pub\Statistic;

use App\Modules\Common\Base\Factories\ModelTranslationFactory;
use App\Modules\Common\Url\Models\Url;

class StatService
{
    public array $hasViewsCount = [Url::GAME, Url::PAGE];

    public function handle(string $entity, $translationId)
    {
        if(!in_array($entity, $this->hasViewsCount)){
            return;
        }

        $translationModel = ModelTranslationFactory:: make($entity);
        $translation = $translationModel->find($translationId);
        $translation->views++;
        $translation->save();
    }
}
