<?php

namespace App\Modules\Admin\Game\Repositories;

use App\Modules\Admin\Game\Models\GameTranslation;
use App\Modules\Common\Base\Repositories\BaseRepository;

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
