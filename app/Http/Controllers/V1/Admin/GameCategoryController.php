<?php

namespace App\Http\Controllers\V1\Admin;


use App\Modules\Admin\Game\DTO\GameCategoryDTO;
use App\Modules\Admin\Game\Requests\GameCategoryStoreRequest;
use App\Modules\Admin\Game\Requests\GameCategoryUpdateRequest;
use App\Modules\Admin\Game\Resources\GameCategoryCollection;
use App\Modules\Admin\Game\Resources\GameCategoryResource;
use App\Modules\Admin\Game\Resources\GameCategorySelectCollection;
use App\Modules\Common\Base\DTO\ParamListDTO;
use App\Modules\Common\Country\Services\CountryService;
use App\Modules\Common\Language\Services\LanguageService;
use App\Modules\Admin\Game\Repositories\GameCategoryRepository;
use App\Modules\Admin\Game\Services\GameCategoryService;
use Illuminate\Http\Request;

class GameCategoryController
{
    private GameCategoryRepository $gameCategoryRepository;
    private GameCategoryService $gameCategoryService;

    public function __construct(
        GameCategoryRepository $gameRepository,
        GameCategoryService $gameService
    )
    {
        $this->gameCategoryRepository = $gameRepository;
        $this->gameCategoryService = $gameService;
    }

    public function index(Request $request)
    {
        $params = ParamListDTO::fromRequest($request, '_lft', 'asc');
        $games = $this->gameCategoryRepository->all(
            $params->getSort(),
            $params->getDir(),
            $params->getFilter(),
            $params->getCount()
        );
        return new GameCategoryCollection($games);
    }

    public function select(Request $request)
    {
        $params = ParamListDTO::fromRequest($request, '_lft', 'asc');
        $games = $this->gameCategoryRepository->all(
            $params->getSort(),
            $params->getDir(),
            $params->getFilter(),
            $params->getCount()
        );
        return new GameCategorySelectCollection($games);
    }

    public function show($id)
    {
        $game = $this->gameCategoryRepository->getById($id);
        return new GameCategoryResource($game);
    }

    public function store(GameCategoryStoreRequest $request)
    {
        $dto = new GameCategoryDTO(
            null,
            $request->parent_id,
            $request->thumb,
            $request->translations,
            CountryService::getCurrent(),
            LanguageService::getCurrent()
        );

        $game = $this->gameCategoryService->createOrUpdate($dto);

        return response()->json([
            'game' => $game
        ]);

    }

    public function update(GameCategoryUpdateRequest $request)
    {

        $dto = new GameCategoryDTO(
            $request->id,
            $request->parent_id,
            $request->thumb,
            $request->translations,
            CountryService::getCurrent(),
            LanguageService::getCurrent()
        );

        $game = $this->gameCategoryService->createOrUpdate($dto);

        return response()->json([
            'game' => $game
        ]);

    }


}
