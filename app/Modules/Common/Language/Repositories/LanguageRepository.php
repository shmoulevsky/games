<?php

namespace App\Modules\Common\Language\Repositories;

use App\Modules\Common\Base\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;


class LanguageRepository extends BaseRepository
{
    protected $modelClass = Languages::class;

    public function getIdByCodes(array $codes)
    {
        return $this->model
            ->select('id')
            ->whereIn('code', $codes)
            ->get();
    }

    public function getByCountry(int $countryId)
    {
        return DB::table('languages')->select('code')
            ->whereIn('id', function ($query) use ($countryId){
           $query->from('countries_languages')
               ->select('language_id')
               ->where('country_id', $countryId);
        })->pluck('code')->toArray();
    }

    public function getDefault(int $countryId)
    {
        return DB::table('countries')
            ->select('default_language')
            ->where('id', $countryId)
            ->first('default_language');
    }
}
