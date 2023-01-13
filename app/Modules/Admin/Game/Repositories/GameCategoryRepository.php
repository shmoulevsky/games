<?php

namespace App\Modules\Admin\Game\Repositories;

use App\Modules\Admin\Game\Models\GameCategory;
use App\Modules\Common\Base\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class GameCategoryRepository extends BaseRepository
{
    protected $modelClass = GameCategory::class;

    public function all($column = 'id', $dir = 'desc', $filter = [], $count = 10)
    {
        return $this->model->select(
            'game_categories.*',
            'game_category_translations.title as title',
            'urls.url as url'
        )
            ->join('game_category_translations', function ($query) {
                $query->on('game_category_translations.game_category_id','=', 'game_categories.id');
                $query->where('game_category_translations.language_id','=', $this->currentLanguage);
            })->leftJoin('urls', function ($join) {
                $join->on('game_categories.id', '=', 'urls.entity_id');
                $join->on('urls.language_id','=', DB::raw($this->currentLanguage));
                $join->on('urls.entity','=', DB::raw("'game_category'"));
            })
            ->orderBy($column, $dir)
            ->get();
    }
}
