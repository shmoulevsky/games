<?php

namespace App\Modules\Pub\Game\Repositories;

use App\Modules\Admin\Game\Models\Game;
use App\Modules\Admin\Game\Models\GameTranslation;
use App\Modules\Common\Base\Repositories\BaseRepository;
use App\Modules\Common\Url\Models\Url;
use Illuminate\Support\Facades\DB;

class GameRepository extends BaseRepository
{
    protected $modelClass = Game::class;

    public function getPageList(
        string $column = 'id',
        string $dir = 'desc',
        array $filter = [],
        int $count = 100
    )
    {
        $builder = $this->model
            ->select(
                'games.id as id',
                'games.thumb as thumb',
                'game_translations.title as title',
                'game_translations.description as description',
                'urls.url as url',
                DB::raw('DATE_FORMAT(games.created_at, "%d.%m.%Y") as date'),
            )->join('game_translations', function ($query) {
                $query->on('game_translations.game_id','=', 'games.id');
                $query->on('game_translations.language_id','=', DB::raw("'".$this->currentLanguage."'"));
            })->join('urls', function ($query) {
                $query->on('urls.entity_id','=', 'games.id');
                $query->on('urls.entity','=', DB::raw("'".Url::GAME."'"));
                $query->on('urls.language_id','=', DB::raw("'".$this->currentLanguage."'"));
            })
            ->where('is_active', 1);

        if(!empty($filter['category_id'])){
            $builder->where('category_id', $filter['category_id']);
        }

        if(!empty($filter['id'])){
            $builder->whereIn('games.id', $filter['id']);
        }

        if($column === 'created_at'){
            $column = 'games.'.$column;
        }

        return $builder->orderBy($column, $dir)->paginate($count);
    }

    public function getPage($id)
    {
        $builder = $this->model
            ->select(
                'games.id as id',
                'games.thumb as thumb',
                'games.game as game',
                'games.category_id as category_id',
                'game_translations.id as translation_id',
                'game_translations.title as title',
                'game_translations.description as description',
                'game_translations.rules as rules',
                'game_translations.views as views',
                'game_translations.comments as comments',
                DB::raw('DATE_FORMAT(games.created_at, "%d.%m.%Y") as date'),
            )->join('game_translations', function ($query) {
                $query->on('game_translations.game_id','=', 'games.id');
                $query->where('game_translations.language_id','=', $this->currentLanguage);
            })
            ->where('games.id', $id)
            ->where('game_translations.language_id', $this->currentLanguage)
            ->where('is_active', 1);

        $game = $builder->first();
        $games = $this->model
            ->select(
                'games.id as id',
                'games.thumb as thumb',
                'game_translations.title as title',
            )->join('game_translations', function ($query) {
                $query->on('game_translations.game_id','=', 'games.id');
                $query->where('game_translations.language_id','=', $this->currentLanguage);
            })
            ->where('game_translations.language_id', $this->currentLanguage)
            ->where('is_active', 1)
            ->limit(3)
            ->inRandomOrder()
            ->get();

        $tags = DB::table('tags')
            ->select(
                'tags.id as id',
                'tag_translations.title as title',
                'urls.url as url',
            )->join('tag_translations', function ($query) {
                $query->on('tag_translations.tag_id','=', 'tags.id');
                $query->where('tag_translations.language_id','=', $this->currentLanguage);
            })
            ->join('urls', function ($query) {
                $query->on('urls.entity_id','=', 'tags.id');
                $query->on('urls.entity','=', DB::raw("'".Url::TAG."'"));
                $query->where('urls.language_id','=', $this->currentLanguage);
            })
            ->whereIn('tags.id', function ($query) use ($game){
                $query->from('taggables')
                    ->select('tag_id')
                    ->where([
                        ['taggable_id', $game->id],
                        ['taggable_type', Url::GAME],
                    ])
                    ->get()
                    ->pluck('tag_id');
            })
            ->get();

        $game->games = $games;
        $game->tags = $tags;

        return $game;
    }

    public function getByTag($tagId)
    {
        return DB::table('taggables')
            ->where('tag_id', $tagId)
            ->get()
            ->pluck('taggable_id')
            ->toArray();
    }

    public function getTranslation(int $entityId, int $languageId)
    {
        return GameTranslation::where([
            ['game_id', $entityId],
            ['language_id', $languageId]
        ])->first();
    }

}
