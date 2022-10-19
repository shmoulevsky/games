<?php

namespace App\Modules\Common\Country\Repositories;


use App\Modules\Common\Base\Repositories\BaseRepository;
use App\Modules\Common\Country\Models\Country;

class CountryRepository extends BaseRepository
{
    protected $modelClass = Country::class;

    public function all($column = 'id', $dir = 'desc')
    {
        return $this->model::with('languages')
            ->orderBy($column, $dir)
            ->get();
    }

}


