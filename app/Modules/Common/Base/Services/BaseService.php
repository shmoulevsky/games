<?php

namespace App\Modules\Common\Base\Services;


abstract class BaseService
{
    protected const DEFAULT_SORT = 100;
    protected const DEFAULT_ACTIVE = 1;

    protected $modelClass;
    protected $repositoryClass;
    public $repository;
    public $model;

    public function __construct()
    {
        if($this->modelClass) {
            $this->model = app()->make($this->modelClass);
        }

        if($this->repositoryClass) {
            $this->repository = app()->make($this->repositoryClass);
        }
    }

    public function getItem($itemId)
    {
        $item = $this->repository->getById($itemId);

        if($itemId > 0 && empty($item)){
            throw new \Exception("Item {$this->modelClass} with id #{$itemId} not found");
        }

        if(empty($item)){
            $item = app()->make($this->modelClass);
        }

        return $item;
    }


}
