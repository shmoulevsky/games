<?php

namespace App\Modules\Game\Services;

use App\Modules\Common\Base\Services\BaseTranslationService;
use App\Modules\Game\Models\Game;
use App\Modules\Game\Models\GameTranslation;
use App\Modules\Game\Repositories\GameRepository;
use App\Modules\Game\Repositories\GameTranslationRepository;
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

            $game->sort = $dto->sort ?? self::DEFAULT_SORT;
            $game->is_active = $dto->is_active ?? self::DEFAULT_ACTIVE;
            $game->game = $dto->game;
            $game->thumb = $dto->thumb ?? null;
            $game->save();

            $this->storeTranslations($dto->translations, $game);

        });

        return $game;
    }
}
