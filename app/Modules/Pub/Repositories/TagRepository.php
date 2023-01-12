<?php

namespace App\Modules\Pub\Repositories;

use App\Modules\Admin\Tag\Models\Tag;
use App\Modules\Common\Base\Repositories\BaseRepository;
use App\Modules\Common\Url\Models\Url;
use Illuminate\Support\Facades\DB;

class TagRepository extends BaseRepository
{
    protected $modelClass = Tag::class;

    public function getByCategory(int $id, string $type, int $language)
    {


        $tags = DB::table('tags')
            ->select(
                'tags.id as tag_id',
                'tag_translations.tag as tag',
                'urls.url'
            )
            ->join('tags_categories', function ($join) use ($type, $id){

                $join->on('tags_categories.tag_id', '=', 'tags.id');
                if($id > 1){
                    $join->on('tags_categories.category_id', '=', DB::raw("'".$id."'"));
                }

            })->join('tag_translations', function ($join) use ($id, $language){
                $join->on('tag_translations.tag_id', '=', 'tags.id');
                $join->on('tag_translations.language_id', '=', DB::raw("'".$language."'"));
            })
            ->join('urls', function ($join) use ($type, $id, $language){

                $join->on('urls.entity_id', '=', 'tags.id');
                $join->on('urls.entity', '=', DB::raw("'".Url::TAG."'"));
                $join->on('urls.language_id', '=', DB::raw("'".$language."'"));

            })
            ->where([
                ['taggable_type', $type]
            ])
            ->get();

        return $tags;

    }

    public function getPage($id)
    {
        $builder = $this->model
            ->select(
                'tags.id as id',
                'tags.taggable_type as type',
                'tag_translations.title as title',
                'tag_translations.description as description',
                'tag_translations.post_description as post_description',
                'tag_translations.seo_title as seo_title',
                'tag_translations.seo_keywords as seo_keywords',
                'tag_translations.seo_description as seo_description',
                'tags_categories.category_id as category_id',
            )->join('tag_translations', function ($query) {
                $query->on('tag_translations.tag_id','=', 'tags.id');
                $query->where('tag_translations.language_id','=', $this->currentLanguage);
            })->join('tags_categories', function ($query) {
                $query->on('tags_categories.tag_id','=', 'tags.id');
            })
            ->where('tags.id', $id)
            ->where('tag_translations.language_id', $this->currentLanguage)
            ->where('is_active', 1);

        return $builder->first();
    }
}
