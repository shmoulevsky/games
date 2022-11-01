<?php

namespace App\Modules\Game\Repositories;

use App\Modules\Common\Base\Repositories\BaseRepository;
use App\Modules\Game\Models\GameTranslation;

class GameTranslationRepository extends BaseRepository
{
    protected $modelClass = GameTranslation::class;

    public function find(string $languageCode, int $gameId)
    {
        return $this->model->where([
            ['language_id', $languageCode],
            ['game_id', $gameId],
        ])->first();
    }
}
