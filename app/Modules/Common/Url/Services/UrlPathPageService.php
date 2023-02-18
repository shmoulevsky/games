<?php

namespace App\Modules\Common\Url\Services;

use App\Modules\Common\Base\Factories\ModelFactory;
use App\Modules\Common\Base\Factories\ModelTranslationFactory;
use App\Modules\Common\Url\Models\Url;

class UrlPathPageService
{
    public function getParentIds($category)
    {
        $parentIds = $category::defaultOrder()
            ->ancestorsOf($category->parent_id)
            ->pluck('id')
            ->toArray();

        $parentIds[] = $category->parent_id;
        $parentIds[] = $category->id;

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

    public function storeUrls($translations, $model, $category, $entity, $pageEntity)
    {
        $parentIds = $this->getParentIds($category);

        foreach ($translations as $languageId => $translation){

            if($languageId === 0) continue;

            $path = '/'.$this->getPath($parentIds, $entity, $languageId).'/'.$translation['seo_url'];

            Url::updateOrCreate(
                [
                    'entity' => $pageEntity,
                    'entity_id' => $model->id,
                    'language_id' => $languageId,
                ],
                [
                    'url' => $path,
                    'is_list' => 0,
                    'list' => null,
                    'entity' => $pageEntity,
                    'entity_id' => $model->id,
                    'language_id' => $languageId,
                ],
            );
        }

    }
}
