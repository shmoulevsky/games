<?php

namespace App\Modules\Pub\Game\Repositories;


use App\Modules\Admin\Game\Models\GameCategory;
use App\Modules\Common\Base\Repositories\BaseRepository;


class GameCategoryRepository extends BaseRepository
{
    protected $modelClass = GameCategory::class;

    public function getPageList(
        string $column = 'id',
        string $dir = 'desc',
        array $filter = [],
        int $count = 10
    )
    {

    }

    public function getPage($id)
    {
        $builder = $this->model
            ->select(
                'game_categories.id as id',
                'game_categories.thumb as thumb',
                'game_category_translations.title as title',
                'game_category_translations.description as description',
            )->join('game_category_translations', function ($query) {
                $query->on('game_category_translations.game_category_id','=', 'game_categories.id');
                $query->where('game_category_translations.language_id','=', $this->currentLanguage);
            })
            ->where('game_categories.id', $id)
            ->where('is_active', 1);

        return $builder->first();
    }
}
