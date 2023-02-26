<?php

namespace App\Modules\Admin\Property\Repositories;


use App\Modules\Common\Base\Repositories\BaseRepository;
use App\Modules\Common\Property\Models\Property;


class PropertyRepository extends BaseRepository
{
    protected $modelClass = Property::class;

    public function all($column = 'id', $dir = 'desc', $filter = [], $count = 10)
    {
        return $this->model->select(
            'properties.*',
            'property_translations.title as title',
        )
            ->join('property_translations', function ($query) {
                $query->on('property_translations.property_id','=', 'properties.id');
                $query->where('property_translations.language_id','=', $this->currentLanguage);
            })
            ->orderBy('id', $dir)
            ->get();
    }
}
