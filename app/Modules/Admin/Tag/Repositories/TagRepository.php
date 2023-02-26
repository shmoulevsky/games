<?php

namespace App\Modules\Admin\Tag\Repositories;

use App\Modules\Admin\Tag\Models\Tag;
use App\Modules\Common\Base\Repositories\BaseRepository;
use App\Modules\Common\Url\Models\Url;
use Illuminate\Support\Facades\DB;

class TagRepository extends BaseRepository
{
    protected $modelClass = Tag::class;

    public function all($column = 'id', $dir = 'desc', $filter = [], $count = 10)
    {
        return $this->model->select(
            'tags.*',
            'tag_translations.title as title',
            'urls.url as url'
        )
            ->join('tag_translations', function ($query) {
                $query->on('tag_translations.tag_id','=', 'tags.id');
                $query->where('tag_translations.language_id','=', $this->currentLanguage);
            })->leftJoin('urls', function ($join) {
                $join->on('tags.id', '=', 'urls.entity_id');
                $join->on('urls.language_id','=', DB::raw($this->currentLanguage));
                $join->on('urls.entity', '=', DB::raw("'".Url::TAG."'"));
            })
            ->orderBy($column, $dir)
            ->get();
    }
}
