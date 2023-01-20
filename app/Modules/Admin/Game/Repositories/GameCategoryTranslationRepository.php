<?php

namespace App\Modules\Admin\Game\Repositories;

use App\Modules\Admin\Game\Models\GameCategoryTranslation;
use App\Modules\Common\Base\Repositories\BaseRepository;

class GameCategoryTranslationRepository extends BaseRepository
{
    protected $modelClass = GameCategoryTranslation::class;

    public function find(string $languageId, int $gameId)
    {
        return $this->model->where([
            ['language_id', $languageId],
            ['game_category_id', $gameId],
        ])->first();
    }
}
