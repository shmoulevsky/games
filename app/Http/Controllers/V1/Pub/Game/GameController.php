<?php

namespace App\Http\Controllers\V1\Pub\Game;

use App\Http\Controllers\V1\Common\Controller;
use App\Modules\Common\Base\DTO\ParamListDTO;
use App\Modules\Pub\Game\Repositories\GameRepository;
use App\Modules\Pub\Game\Resources\GameCollection;
use App\Modules\Pub\Game\Resources\GameResource;
use Illuminate\Http\Request;

class GameController extends Controller
{
    private GameRepository $gameRepository;

    public function __construct(
        GameRepository $gameRepository
    )
    {
        $this->gameRepository = $gameRepository;
    }

    public function index(Request $request)
    {
        $params = ParamListDTO::fromRequest($request, 'created_at', 'desc');
        $users = $this->gameRepository->all(
            $params->getSort(),
            $params->getDir(),
            $params->getFilter(),
            $params->getCount()
        );
        return new GameCollection($users);
    }

    public function show($id)
    {
        $user = $this->gameRepository->getDetail($id);
        return new GameResource($user);
    }
}
