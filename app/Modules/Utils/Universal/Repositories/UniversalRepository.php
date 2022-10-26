<?php

namespace App\Modules\Utils\Universal\Repositories;

class UniversalRepository
{
    protected $model;

    public function __construct($modelClass)
    {
        if($modelClass) {
            $this->model = app()->make($modelClass);
        }
    }

    public function getById(?int $id)
    {
        if((int)$id === 0) {
            return null;
        }
        return $this->model->find($id);
    }

    public function all($select, $sort = 'id', $dir = 'desc', $filters = [], $count = 10)
    {
        $builder = $this->model->select($select);

        if(count($filters) > 0){
            foreach ($filters as $filterItem)
            $builder->where( $filterItem['column'], $filterItem['operator'], $filterItem['value']);
        }

        return  $builder->orderBy($sort, $dir)->paginate($count);
    }

}
