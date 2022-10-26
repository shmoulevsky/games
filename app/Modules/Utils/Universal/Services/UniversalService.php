<?php

namespace App\Modules\Utils\Universal\Services;

class UniversalService
{
    private $model;

    public function __construct($model)
    {
        $this->model = app()->make($model);
    }

    public function createOrUpdate($dto)
    {
        return $this->model::updateOrCreate(['id' => $dto['id']], $dto);
    }

    public function delete(array $dto)
    {
        $this->model::findOrFail($dto['id'])->delete();
    }
}
