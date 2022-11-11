<?php

namespace App\Modules\Admin\Tag\Repositories;

use App\Modules\Common\Base\Repositories\BaseRepository;
use App\Modules\Common\Url\Models\Url;
use Illuminate\Support\Facades\DB;

class TagRepository extends BaseRepository
{
    public function getByCategory(int $id, string $type, int $language){

        $tags = DB::table('tags')
            ->select('tags.tag as tag', 'urls.url')
            ->join('taggables', function ($join) use ($type, $id){

                $join->on('taggables.tag_id', '=', 'tags.id');
                $join->on('taggables.taggable_type', '=', DB::raw("'".$type."'"));

                if($id > 1){
                    $join->on('taggables.category_id', '=', DB::raw("'".$id."'"));
                }

            })->join('urls', function ($join) use ($type, $id, $language){

                $join->on('urls.entity_id', '=', 'tags.id');
                $join->on('urls.entity', '=', DB::raw("'".Url::TAG."'"));
                $join->on('urls.language_id', '=', DB::raw("'".$language."'"));

            })
            ->get();

        return $tags;

    }
}
