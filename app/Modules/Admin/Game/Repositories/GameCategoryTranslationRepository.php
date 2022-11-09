<?php

namespace App\Modules\Admin\Game\Repositories;

use App\Modules\Admin\Game\Models\GameCategoryTranslation;
use App\Modules\Common\Base\Repositories\BaseRepository;

class GameCategoryTranslationRepository extends BaseRepository
{
    protected $modelClass = GameCategoryTranslation::class;
}
