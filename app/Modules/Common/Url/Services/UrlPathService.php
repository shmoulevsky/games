<?php

namespace App\Modules\Common\Url\Services;

use App\Modules\Common\Base\Factories\ModelFactory;
use App\Modules\Common\Base\Factories\ModelTranslationFactory;
use App\Modules\Common\Url\Models\Url;

class UrlPathService
{
    public function getParentIds($model)
    {
        $parentIds = $model::defaultOrder()
            ->ancestorsOf($model->parent_id)
            ->pluck('id')
            ->toArray();

        $parentIds[] = $model->parent_id;
        $parentIds[] = $model->id;

        return $parentIds;
    }

    public function getPath($parentIds, $entity, $languageId)
    {
        $factoryTranslation = new ModelTranslationFactory();
        $modelTranslation = $factoryTranslation->make($entity);

        return $modelTranslation
            ->whereIn($modelTranslation->point_column, $parentIds)
            ->where('language_id', $languageId)
            ->select('seo_url')
            ->get()
            ->pluck('seo_url')
            ->implode('/');

    }

    public function storeUrls($translations, $model, $entity)
    {
        $parentIds = $this->getParentIds($model);

        foreach ($translations as $languageId => $translation){

            if($languageId === 0) continue;

            $path = '/'.$this->getPath($parentIds, $entity, $languageId);

            Url::updateOrCreate(
                [
                    'entity' => $entity,
                    'entity_id' => $model->id,
                    'language_id' => $languageId,
                ],
                [
                    'url' => $path,
                    'is_list' => $this->getIsList($entity),
                    'list' => $this->getListColumn($entity),
                    'entity' => $entity,
                    'entity_id' => $model->id,
                    'language_id' => $languageId,
                ],
            );
        }

    }

    private function getListColumn($entity)
    {
        switch ($entity){
            case Url::GAME : return null;
            case Url::GAME_CATEGORY : return [Url::GAME];
            case Url::ARTICLE : return null;
            case Url::ARTICLE_CATEGORY : return [Url::ARTICLE];
            case Url::PAGE : return null;
            case Url::PAGE_CATEGORY : return [Url::PAGE];
            case Url::TAG : return null;
        }
    }

    private function getIsList($entity)
    {
        switch ($entity){
            case Url::GAME : return 0;
            case Url::GAME_CATEGORY : return 1;
            case Url::ARTICLE : return 0;
            case Url::ARTICLE_CATEGORY : return 1;
            case Url::PAGE : return 0;
            case Url::PAGE_CATEGORY : return 1;
            case Url::TAG : return 0;
        }
    }


}
