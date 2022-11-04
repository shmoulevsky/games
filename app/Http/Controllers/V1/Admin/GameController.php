<?php

namespace App\Http\Controllers\V1\Admin;


use App\Http\Controllers\V1\Common\BaseController;
use App\Modules\Game\Repositories\GameRepository;
use App\Modules\Game\Requests\GameDeleteRequest;
use App\Modules\Game\Requests\GameStoreRequest;
use App\Modules\Game\Requests\GameUpdateRequest;
use App\Modules\Game\Resources\GameCollection;
use App\Modules\Game\Resources\GameResource;
use App\Modules\Game\Services\GameService;

class GameController extends BaseController
{
    protected string $repositoryClass = GameRepository::class;
    protected string $serviceClass = GameService::class;
    protected string $collectionClass = GameCollection::class;
    protected string $resourceClass = GameResource::class;

    protected $storeRequestClass = GameStoreRequest::class;
    protected $updateRequestClass = GameUpdateRequest::class;
    protected $deleteRequestClass = GameDeleteRequest::class;

    protected string $defaultSort = 'id';
    protected string $defaultDir = 'asc';
}
