<?php

namespace App\Modules\Common\Language\Repositories;


use App\Modules\Common\Base\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class LanguageGroupRepository extends BaseRepository
{
    public function search($query, $languageId)
    {
        return DB::table('languages_values')
            ->select([
                'id',
                'code as code',
                'group',
                'translation',
            ])
            ->where([
                ['code','like', '%'.$query.'%'],
                ['language_id', $languageId],
            ])->orWhere([
                ['translation','like', '%'.$query.'%'],
                ['language_id', $languageId],
            ])
            ->get()
            ->groupBy('group');
    }
}
