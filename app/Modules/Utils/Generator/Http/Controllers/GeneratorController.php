<?php

namespace App\Modules\Utils\Generator\Http\Controllers;

use App\Modules\Utils\Generator\DTO\GeneratorTableSettingDTO;
use App\Modules\Utils\Generator\Http\Requests\TableHandleRequest;
use App\Modules\Utils\Generator\Repositories\TableRepository;
use App\Modules\Utils\Generator\Services\GeneratorTableSettingService;
use App\Modules\Utils\Generator\Services\ListGeneratorService;
use Illuminate\Http\Request;

class GeneratorController
{
    private TableRepository $tableRepository;
    private ListGeneratorService $listGeneratorService;
    private GeneratorTableSettingService $generatorTableSettingService;

    public function __construct(
        ListGeneratorService $listGeneratorService,
        GeneratorTableSettingService $generatorTableSettingService,
        TableRepository $tableRepository
    )
    {
        $this->tableRepository = $tableRepository;
        $this->listGeneratorService = $listGeneratorService;
        $this->generatorTableSettingService = $generatorTableSettingService;
    }

    public function list(TableHandleRequest $request)
    {
        $list = $this->listGeneratorService->handle($request->columns, $request->table);

        $dto = new GeneratorTableSettingDTO(
            $request->table,
            $list,
            null
        );

        $this->generatorTableSettingService->createOrUpdate($dto);
        return response()->json($list);
    }

    public function form(Request $request)
    {

    }


}
