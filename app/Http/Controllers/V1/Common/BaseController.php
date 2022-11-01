<?php

namespace App\Http\Controllers\V1\Common;

use App\Modules\Common\Base\DTO\ParamListDTO;
use App\Modules\Utils\Universal\Factory\DTOFactory;
use Illuminate\Http\Request;

abstract class BaseController
{

    protected string $repositoryClass;
    protected string $serviceClass;
    protected string $collectionClass;
    protected string $resourceClass;

    protected $storeRequestClass;
    protected $updateRequestClass;
    protected $deleteRequestClass;

    protected string $defaultSort = 'id';
    protected string $defaultDir = 'asc';

    protected $repository;
    protected $service;
    protected $storeRequest;
    protected $updateRequest;
    protected $deleteRequest;

    public function __construct(Request $request)
    {
        $this->repository = app()->make($this->repositoryClass);
        $this->service = app()->make($this->serviceClass);

        $this->storeRequest = app()->make($this->storeRequestClass);
        $this->updateRequest = app()->make($this->updateRequestClass);
        $this->deleteRequest = app()->make($this->deleteRequestClass);
    }

    public function index(Request $request)
    {
        $params = ParamListDTO::fromRequest($request, $this->defaultSort, $this->defaultDir);

        $items = $this->repository->all(
            $params->getSort(),
            $params->getDir(),
            $params->getFilter(),
            $params->getCount()
        );

        return app()->make($this->collectionClass, [$items]);
    }

    public function show(Request $request)
    {
        $item = $this->repository->getById($request->id);
        return app()->make($this->resourceClass, ['resource' => $item]);
    }

    public function store(Request $request)
    {
        $validated = $this->storeRequest->validate($request);
        $dto = DTOFactory::fromRequest($validated);
        $item = $this->service->createOrUpdate($dto);
        return response()->json(['item' => $item]);
    }

    public function update(Request $request)
    {
        $validated = $this->updateRequest->validate($request);
        $dto = DTOFactory::fromRequest($validated);
        $item = $this->service->createOrUpdate($dto->toArray());
        return response()->json(['item' => $item]);
    }

    public function delete(Request $request)
    {
        $validated = $this->deleteRequest->validate($request);
        $dto = DTOFactory::fromRequest($validated);
        $this->service->delete($dto->toArray());
        return response()->json(['status' => 'ok']);
    }


}
