<?php

namespace App\Modules\Admin\Game\Repositories;

use App\Modules\Admin\Game\Models\Game;
use App\Modules\Common\Base\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class GameRepository extends BaseRepository
{
    protected $modelClass = Game::class;

    public function all($column = 'id', $dir = 'desc', $filter = [], $count = 10)
    {
        return $this->model->select(
            'games.*',
            'game_translations.title as title',
            'urls.url as url'
        )
            ->join('game_translations', function ($query) {
                $query->on('game_translations.game_id','=', 'games.id');
                $query->where('game_translations.language_id','=', $this->currentLanguage);
            })->leftJoin('urls', function ($join) {
                $join->on('games.id', '=', 'urls.entity_id');
                $join->on('urls.language_id','=', DB::raw($this->currentLanguage));
                $join->on('urls.entity','=', DB::raw('game'));
            })
            ->orderBy($column, $dir)
            ->get();
    }

}
