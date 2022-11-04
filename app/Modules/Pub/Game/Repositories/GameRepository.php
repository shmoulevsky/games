<?php

namespace App\Modules\Pub\Game\Repositories;

use App\Modules\Admin\Game\Models\Game;
use App\Modules\Common\Base\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class GameRepository extends BaseRepository
{
    protected $modelClass = Game::class;

    public function all(
        string $column = 'id',
        string $dir = 'desc',
        array $filter = [],
        int $count = 10
    )
    {
        $builder = $this->model
            ->select(
                'games.id as id',
                'games.thumb as thumb',
                'game_translations.title as title',
                'game_translations.description as description',
                'game_translations.rules as rules',
                DB::raw('DATE_FORMAT(games.created_at, "%d.%m.%Y") as date'),
            )->join('game_translations', function ($query) {
                $query->on('game_translations.game_id','=', 'games.id');
                $query->where('game_translations.language_id','=', $this->currentLanguage);
            })->where('is_active', 1);

        return $builder->orderBy($column, $dir)->paginate($count);
    }

    public function getDetail($id)
    {
        $builder = $this->model
            ->select(
                'games.id as id',
                'games.thumb as thumb',
                'games.game as game',
                'game_translations.title as title',
                'game_translations.description as description',
                'game_translations.rules as rules',
                DB::raw('DATE_FORMAT(games.created_at, "%d.%m.%Y") as date'),
            )->join('game_translations', function ($query) {
                $query->on('game_translations.game_id','=', 'games.id');
                $query->where('game_translations.language_id','=', $this->currentLanguage);
            })->where('is_active', 1);

        return $builder->get();
    }
}
