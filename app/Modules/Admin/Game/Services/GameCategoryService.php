<?php

namespace App\Modules\Admin\Game\Services;



use App\Modules\Admin\Game\Models\GameCategory;
use App\Modules\Admin\Game\Models\GameCategoryTranslation;
use App\Modules\Admin\Game\Repositories\GameCategoryRepository;
use App\Modules\Admin\Game\Repositories\GameCategoryTranslationRepository;
use App\Modules\Common\Base\Services\BaseTranslationService;
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
        $game = $this->getItem($dto->id);

        DB::transaction(function () use ($dto, $game){


            $game->thumb = $dto->thumb ?? null;
            $game->category_id = $dto->category_id ?? null;
            $game->save();

            $this->storeTranslations($dto->translations, $game);

        });

        return $game;
    }
}
