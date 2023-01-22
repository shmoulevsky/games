<?php

namespace App\Modules\Admin\Game\Services;



use App\Modules\Admin\Game\Models\GameCategory;
use App\Modules\Admin\Game\Models\GameCategoryTranslation;
use App\Modules\Admin\Game\Repositories\GameCategoryRepository;
use App\Modules\Admin\Game\Repositories\GameCategoryTranslationRepository;
use App\Modules\Common\Base\Services\BaseTranslationService;
use App\Modules\Common\Url\Models\Url;
use App\Modules\Common\Url\Services\UrlPathService;
use Illuminate\Support\Facades\DB;

class GameCategoryService extends BaseTranslationService
{

    protected $modelClass = GameCategory::class;
    protected $repositoryClass = GameCategoryRepository::class;
    protected string $modelTranslationClass = GameCategoryTranslation::class;
    protected string $repositoryTranslationClass = GameCategoryTranslationRepository::class;
    protected string $linkProperty = 'game_category_id';

    public function createOrUpdate($dto) : GameCategory
    {
        $category = $this->getItem($dto->id);

        DB::transaction(function () use ($dto, $category, ){

            $category->thumb = $dto->thumb ?? null;
            $category->parent_id = $dto->parentId ?? null;
            $category->save();

            $result = GameCategory::withDepth()->find($category->id);
            $depth = $result->depth;
            $category->depth = $depth;
            $category->save();

            $this->storeTranslations($dto->translations, $category);
            $this->urlPathService->storeUrls($dto->translations, $category, Url::GAME_CATEGORY);

        });

        return $category;
    }
}
