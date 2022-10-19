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
    private const DEFAULT_LANGUAGE = 'ru_RU';

    public static function getCurrent()
    {
        $language = request()->header('language') ? request()->header('language') : self::getDefault();

        if($language === 'undefined') {
            $language = self::getDefault();
        }

        return $language;

    }

    public static function prepareSettings($entitySettings, $entityDescriptions, $form = [])
    {
        $langs = Arr::pluck(Language::all('code'), 'code');
        $descriptions = array_fill_keys($langs, $entityDescriptions);
        $entitySettings->private = 1;

        return [
            'descriptions' => $descriptions,
            'setting' => $entitySettings,
            'form' => $form,
        ];
    }

    public static function getDefault()
    {
        return DB::table('countries')
            ->select('default_language')
            ->where('id', CountryService::getCurrent())
            ->first('default_language')?->default_language;
    }

    public static function getAvailable($countryId)
    {
        return DB::table('languages')
            ->select('languages.code')
            ->whereIn('id', function ($query) use ($countryId){
                $query->from('countries_languages')
                    ->select('language_id')
                    ->where('country_id', $countryId);
            })->get()->pluck('code')->toArray();
    }

    public static function getAvailableCount(int $countryId)
    {
        return DB::table('languages')
            ->select('languages.code')
            ->whereIn('id', function ($query) use ($countryId){
                $query->from('countries_languages')
                    ->select('language_id')
                    ->where('country_id', $countryId);
            })->count();
    }

    public static function storeFile()
    {
        $languageValueRepository = app()->make(LanguageValueRepository::class);
        $languages = Language::where('status', 1)->get();
        $path = [];

        foreach ($languages as $language){
            $languagesValues = $languageValueRepository->getByLanguageCode($language->code);
            $values = new LanguageValueCollection($languagesValues);
            Storage::disk('local')->put("public/languages/language-values-{$language->code}.json", $values->toJson());
            $path[] = "/storage/languages/language-values-{$language->code}.json";
        }

        return $path;

    }

    public static function getCurrentFull()
    {
        $languageCode = self::getCurrent();
        return Language::where('code', $languageCode)->first();
    }

}
