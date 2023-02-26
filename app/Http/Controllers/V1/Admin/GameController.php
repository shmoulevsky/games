<?php

namespace App\Http\Controllers\V1\Admin;


use App\Modules\Admin\Game\DTO\GameDTO;
use App\Modules\Admin\Game\Repositories\GameRepository;
use App\Modules\Admin\Game\Requests\GameStoreRequest;
use App\Modules\Admin\Game\Resources\GameCollection;
use App\Modules\Admin\Game\Resources\GameResource;
use App\Modules\Admin\Game\Services\GameService;
use App\Modules\Common\Base\DTO\ParamListDTO;
use App\Modules\Common\Country\Services\CountryService;
use App\Modules\Common\Language\Services\LanguageService;
use Illuminate\Http\Request;

class GameController
{
    private GameRepository $gameRepository;
    private GameService $gameService;

    public function __construct(
        GameRepository $gameRepository,
        GameService $gameService
    )
    {
        $this->gameRepository = $gameRepository;
        $this->gameService = $gameService;
    }

    public function index(Request $request)
    {
        $params = ParamListDTO::fromRequest($request, 'created_at', 'desc');
        $games = $this->gameRepository->all(
            $params->getSort(),
            $params->getDir(),
            $params->getFilter(),
            $params->getCount()
        );
        return new GameCollection($games);
    }

    public function show($id)
    {
        $game = $this->gameRepository->getFullById($id);
        return new GameResource($game);
    }

    public function store(GameStoreRequest $request)
    {
        $dto = new GameDTO(
            null,
            $request->game,
            $request->thumb,
            $request->category_id,
            $request->translations,
            CountryService::getCurrent(),
            LanguageService::getCurrent()
        );

        $game = $this->gameService->createOrUpdate($dto);

        return response()->json([
            'game' => $game
        ]);

    }

    public function update(Request $request)
    {

        $dto = new GameDTO(
            $request->id,
            $request->game,
            $request->thumb,
            $request->category_id,
            $request->translations,
            CountryService::getCurrent(),
            LanguageService::getCurrent()
        );

        $game = $this->gameService->createOrUpdate($dto);

        return response()->json([
            'game' => $game
        ]);

    }


}
