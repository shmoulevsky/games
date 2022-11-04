<?php

namespace App\Http\Controllers\V1\Admin;


use App\Http\Controllers\V1\Common\BaseController;
use App\Modules\Admin\Game\Repositories\GameRepository;
use App\Modules\Admin\Game\Requests\GameDeleteRequest;
use App\Modules\Admin\Game\Requests\GameStoreRequest;
use App\Modules\Admin\Game\Requests\GameUpdateRequest;
use App\Modules\Admin\Game\Resources\GameCollection;
use App\Modules\Admin\Game\Resources\GameResource;
use App\Modules\Admin\Game\Services\GameService;

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
