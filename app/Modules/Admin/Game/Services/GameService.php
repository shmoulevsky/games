<?php

namespace App\Modules\Admin\Game\Services;

use App\Modules\Admin\Game\Models\Game;
use App\Modules\Admin\Game\Models\GameTranslation;
use App\Modules\Admin\Game\Repositories\GameRepository;
use App\Modules\Admin\Game\Repositories\GameTranslationRepository;
use App\Modules\Common\Base\Services\BaseTranslationService;
use Illuminate\Support\Facades\DB;

class GameService extends BaseTranslationService
{

    protected $modelClass = Game::class;
    protected $repositoryClass = GameRepository::class;
    protected string $modelTranslationClass = GameTranslation::class;
    protected string $repositoryTranslationClass = GameTranslationRepository::class;
    protected string $linkProperty = 'game_id';

    public function createOrUpdate($dto) : Game
    {
        $game = $this->getItem($dto->id);

        DB::transaction(function () use ($dto, $game){

            $game->game = $dto->game;
            $game->thumb = $dto->thumb ?? null;
            $game->category_id = $dto->categoryId ?? null;
            $game->save();

            $this->storeTranslations($dto->translations, $game);

        });

        return $game;
    }
}
