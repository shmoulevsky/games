<?php

namespace App\Modules\Common\Country\Services;

use App\Modules\Common\Base\Services\BaseService;
use App\Modules\Common\Country\DTO\CountryDTO;
use App\Modules\Common\Country\Models\Country;
use App\Modules\Common\Country\Repositories\CountryRepository;
use App\Modules\Common\Language\Repositories\LanguageRepository;
use Illuminate\Support\Facades\DB;


class CountryService extends BaseService
{
    const DEFAULT_COUNTRY = 1;
    private $languageRepository;

    protected $modelClass = Country::class;
    protected $repositoryClass = CountryRepository::class;

    public function __construct(
        LanguageRepository $languageRepository
    )
    {
        parent::__construct();
        $this->languageRepository = $languageRepository;
    }

    public static function getCurrent() : int
    {
        $countryId = request()->headers->get('country');

        if(empty($countryId)) {

            $host = request()->getHttpHost();
            $host = str_ireplace(':8085','',$host);

            $country = DB::table('countries')
                ->select('id')
                ->where('domain', $host)
                ->first();

            if(!empty($country)) {
                return $country->id;
            }
        }

        if(empty($countryId)) {
            $countryId = self::DEFAULT_COUNTRY;
        }

        return $countryId;
    }

    public function createOrUpdate(CountryDTO $countryDTO) : Country
    {
        $country = $this->getItem($countryDTO->id);

        DB::transaction(function () use ($countryDTO, $country){

            $country->name = $countryDTO->name;
            $country->domain = $countryDTO->domain;
            $country->iso = $countryDTO->iso;
            $country->sort = $countryDTO->sort;
            $country->is_active = $countryDTO->is_active;
            $country->default_language = $countryDTO->default_language;
            $country->currency_id = $countryDTO->currency ?? 1;
            $country->info = $countryDTO->getInfo();
            $country->save();

            if(count($countryDTO->languages) > 0) {
                $languageIds = $this->languageRepository->getIdByCodes($countryDTO->languages);
                $country->languages()->sync($languageIds);
            }

        });

        return $country;
    }


}
