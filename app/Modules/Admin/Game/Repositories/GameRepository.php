<?php

namespace App\Modules\Admin\Game\Repositories;

use App\Modules\Admin\Game\Models\Game;
use App\Modules\Common\Base\Repositories\BaseRepository;

class GameRepository extends BaseRepository
{
    protected $modelClass = Game::class;
}
