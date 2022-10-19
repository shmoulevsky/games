<?php

namespace App\Modules\Common\Base\Repositories;


use App\Modules\Common\Country\Services\CountryService;
use App\Modules\Common\Language\Services\LanguageService;

abstract class BaseRepository
{
    const BASE_COUNT = 100;
    const BASE_COUNT_PUBLIC = 20;
    protected $currentLanguage;
    protected $currentCountry;
    protected $modelClass;
    protected $model;

    public function __construct()
    {
        $this->currentLanguage = LanguageService::getCurrent();
        $this->currentCountry = CountryService::getCurrent();

        if($this->modelClass) {
            $this->model = app()->make($this->modelClass);
        }

    }

    public static function getBaseCount()
    {
        return self::BASE_COUNT;
    }

    public static function getPublicBaseCount()
    {
        return self::BASE_COUNT_PUBLIC;
    }

    public function getById(?int $id)
    {
        if((int)$id === 0) {
            return null;
        }
        return $this->model->find($id);
    }

    public function getByIds(?array $ids, array $select = ['id'], array $order = [])
    {
        if(empty($ids)) {
            return null;
        }

        if(empty($order)){
            $order = ['id' => 'desc'];
        }

        return $this->model
            ->select($select)
            ->whereIn('id', $ids)
            ->get();
    }

    public function setCurrentLanguage($currentLanguage): void
    {
        $this->currentLanguage = $currentLanguage;
    }

    public function getCurrentLanguage()
    {
        return $this->currentLanguage;
    }
}
