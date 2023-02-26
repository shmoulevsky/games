<?php

namespace App\Modules\Common\Language\Services;


use App\Modules\Common\Country\Services\CountryService;
use App\Modules\Common\Language\Models\Language;
use App\Modules\Common\Language\Repositories\LanguageValueRepository;
use App\Modules\Language\Resources\LanguageValueCollection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class LanguageService
{
    private const DEFAULT_LANGUAGE = 1;

    public static function getCurrent()
    {
        $language = request()->header('language') ? request()->header('language') : self::getDefault();

        if($language === 'undefined') {
            $language = self::getDefault();
        }

        return $language;

    }

    public static function getDefault()
    {
        return DB::table('countries')
            ->select('default_language')
            ->where('id', CountryService::getCurrent())
            ->first('default_language')?->default_language;
    }
}
