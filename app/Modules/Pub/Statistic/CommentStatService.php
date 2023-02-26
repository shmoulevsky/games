<?php

namespace App\Modules\Pub\Statistic;

use App\Modules\Common\Base\Factories\ModelTranslationFactory;
use App\Modules\Common\Base\Factories\RepositoryFactory;
use App\Modules\Common\Url\Models\Url;

class CommentStatService
{
    public array $hasCommentsCount = [Url::GAME, Url::PAGE];

    public function handle(int $entityId, string $entityType, int $languageId)
    {
        if(!in_array($entityType, $this->hasCommentsCount)){
            return;
        }

        $repository = RepositoryFactory::make($entityType);
        $translation = $repository->getTranslation($entityId, $languageId);
        $translation->comments++;
        $translation->save();
    }
}
