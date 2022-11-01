<?php

namespace App\Modules\Game\Repositories;

use App\Modules\Common\Base\Repositories\BaseRepository;
use App\Modules\Game\Models\Game;

class GameRepository extends BaseRepository
{
    protected $modelClass = Game::class;
}
