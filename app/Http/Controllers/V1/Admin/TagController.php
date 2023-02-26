<?php

namespace App\Http\Controllers\V1\Admin;


use App\Modules\Admin\Game\DTO\GameDTO;
use App\Modules\Admin\Game\Repositories\GameRepository;
use App\Modules\Admin\Game\Requests\GameStoreRequest;
use App\Modules\Admin\Game\Resources\GameCollection;
use App\Modules\Admin\Game\Resources\GameResource;
use App\Modules\Admin\Game\Services\GameService;
use App\Modules\Admin\Tag\DTO\TagDTO;
use App\Modules\Admin\Tag\Repositories\TagRepository;
use App\Modules\Admin\Tag\Requests\TagStoreRequest;
use App\Modules\Admin\Tag\Resources\TagCollection;
use App\Modules\Admin\Tag\Resources\TagResource;
use App\Modules\Admin\Tag\Services\TagService;
use App\Modules\Common\Base\DTO\ParamListDTO;
use App\Modules\Common\Country\Services\CountryService;
use App\Modules\Common\Language\Services\LanguageService;
use Illuminate\Http\Request;

class TagController
{

    private TagRepository $tagRepository;
    private TagService $tagService;

    public function __construct(
        TagRepository $tagRepository,
        TagService $tagService
    )
    {
        $this->tagRepository = $tagRepository;
        $this->tagService = $tagService;
    }

    public function index(Request $request)
    {
        $params = ParamListDTO::fromRequest($request, 'created_at', 'desc');
        $tags = $this->tagRepository->all(
            $params->getSort(),
            $params->getDir(),
            $params->getFilter(),
            $params->getCount()
        );
        return new TagCollection($tags);
    }

    public function show($id)
    {
        $tag = $this->tagRepository->getById($id);
        return new TagResource($tag);
    }

    public function store(TagStoreRequest $request)
    {
        $dto = new TagDTO(
            null,
            $request->category_id,
            $request->translations,
            CountryService::getCurrent(),
            LanguageService::getCurrent()
        );

        $tag = $this->tagService->createOrUpdate($dto);

        return response()->json([
            'tag' => $tag
        ]);

    }




}
