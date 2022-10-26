<?php

namespace App\Http\Controllers\V1\Admin;

use App\Models\User;
use App\Modules\Common\Base\DTO\ParamListDTO;
use App\Modules\Utils\Universal\DTO\UniversalDTO;
use App\Modules\Utils\Universal\Factory\DTOFactory;
use App\Modules\Utils\Universal\Repositories\UniversalRepository;
use App\Modules\Utils\Universal\Resources\UniversalCollection;
use App\Modules\Utils\Universal\Services\UniversalService;
use Illuminate\Http\Request;

class UniversalController
{

    private UniversalRepository $repository;
    private UniversalService $service;

    public function __construct(Request $request)
    {
        $model = "App\Models\\".ucfirst($request->model);
        $this->repository = new UniversalRepository($model);
        $this->service = new UniversalService($model);
    }

    public function index(Request $request)
    {
        $params = ParamListDTO::fromRequest($request, 'created_at', 'desc');

        $items = $this->repository->all(
            '*',
            $params->getSort(),
            $params->getDir(),
            $params->getFilter(),
            $params->getCount()
        );
        return new UniversalCollection($items);
    }

    public function show(Request $request)
    {
        return $this->repository->getById($request->id);
    }

    public function store(Request $request)
    {
        $dto = DTOFactory::fromRequest($request);
        $item = $this->service->createOrUpdate($dto->toArray());
        return response()->json(['item' => $item]);
    }

    public function update(Request $request)
    {
        $dto = DTOFactory::fromRequest($request);
        $item = $this->service->createOrUpdate($dto->toArray());
        return response()->json(['item' => $item]);
    }

    public function delete(Request $request)
    {
        $dto = DTOFactory::fromRequest($request);
        $this->service->delete($dto->toArray());
        return response()->json(['status' => 'ok']);
    }


}
