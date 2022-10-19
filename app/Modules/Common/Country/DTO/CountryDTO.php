<?php

namespace App\Modules\Common\Country\DTO;

class CountryDTO
{
    public $id;
    public $name;
    public $iso;
    public $sort;
    public $is_active;
    public $domain;
    public $languages;
    public $default_language;
    public $info;
    public $currency;
    public $cities;

    public function __construct(
        ?int    $id,
        string $name,
        string $domain,
        string $iso,
        int  $sort,
        bool $is_active,
        array $languages,
        string $default_language,
        array $info,
        ?array $cities,
        ?int $currency
    ){
        $this->id = $id;
        $this->name = $name;
        $this->iso = $iso;
        $this->sort = $sort;
        $this->is_active = $is_active;
        $this->domain = $domain;
        $this->languages = $languages;
        $this->default_language = $default_language;
        $this->info = $info;
        $this->currency = $currency;
        $this->cities = $cities;
    }

    public function getInfo()
    {
        return json_encode($this->info);
    }
}
