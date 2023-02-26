<?php

namespace App\Http\Controllers\V1\Admin;


use App\Modules\Admin\Game\DTO\GameDTO;
use App\Modules\Admin\Game\Repositories\GameRepository;
use App\Modules\Admin\Game\Requests\GameStoreRequest;
use App\Modules\Admin\Game\Resources\GameCollection;
use App\Modules\Admin\Game\Resources\GameResource;
use App\Modules\Admin\Game\Services\GameService;
use App\Modules\Admin\Property\DTO\PropertyDTO;
use App\Modules\Admin\Property\Repositories\PropertyRepository;
use App\Modules\Admin\Property\Requests\PropertyStoreRequest;
use App\Modules\Admin\Property\Resources\PropertyCollection;
use App\Modules\Admin\Property\Resources\PropertyResource;
use App\Modules\Admin\Property\Services\PropertyService;
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

class PropertyController
{
    private PropertyRepository $propertyRepository;
    private PropertyService $proprtyService;

    public function __construct(
        PropertyRepository $propertyRepository,
        PropertyService $propertyService
    )
    {
        $this->propertyRepository = $propertyRepository;
        $this->propertyService = $propertyService;
    }

    public function index(Request $request)
    {
        $params = ParamListDTO::fromRequest($request, 'created_at', 'desc');
        $properties = $this->propertyRepository->all(
            $params->getSort(),
            $params->getDir(),
            $params->getFilter(),
            $params->getCount()
        );
        return new PropertyCollection($properties);
    }

    public function show($id)
    {
        $property = $this->propertyRepository->getById($id);
        return new PropertyResource($property);
    }

    public function store(PropertyStoreRequest $request)
    {
        $dto = new PropertyDTO(
            null,
            (int)$request->is_show_list,
            (int)$request->is_show_form,
            $request->translations,
        );

        $property = $this->propertyService->createOrUpdate($dto);

        return response()->json([
            'property' => $property
        ]);

    }

    public function update(PropertyStoreRequest $request)
    {
        $dto = new PropertyDTO(
            $request->id,
            (int)$request->is_show_list,
            (int)$request->is_show_form,
            $request->translations,
        );

        $property = $this->propertyService->createOrUpdate($dto);

        return response()->json([
            'property' => $property
        ]);

    }




}
