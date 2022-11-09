<?php

namespace App\Modules\Admin\Game\Repositories;

use App\Modules\Admin\Game\Models\GameCategory;
use App\Modules\Common\Base\Repositories\BaseRepository;

class GameCategoryRepository extends BaseRepository
{
    protected $modelClass = GameCategory::class;
}
