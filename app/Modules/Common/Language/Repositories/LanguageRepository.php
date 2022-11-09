<?php

namespace App\Modules\Common\Language\Repositories;

use App\Modules\Common\Base\Repositories\BaseRepository;
use App\Modules\Common\Language\Models\Language;


class LanguageRepository extends BaseRepository
{
    protected $modelClass = Language::class;

    public function getIdByCodes(array $codes)
    {
        return $this->model
            ->select('id')
            ->whereIn('code', $codes)
            ->get();
    }

    public function getAll()
    {
        return $this->model
            ->select('id', 'code', 'name')
            ->get();
    }
}
