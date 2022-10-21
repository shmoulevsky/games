<?php

namespace App\Modules\Utils\Generator\Http\Controllers;

use App\Modules\Utils\Generator\Http\Requests\TableHandleRequest;
use App\Modules\Utils\Generator\Repositories\TableRepository;
use App\Modules\Utils\Generator\Services\ListGeneratorService;
use Illuminate\Http\Request;

class GeneratorController
{
    private TableRepository $tableRepository;
    private ListGeneratorService $listGeneratorService;

    public function __construct(
        ListGeneratorService $listGeneratorService,
        TableRepository $tableRepository
    )
    {
        $this->tableRepository = $tableRepository;
        $this->listGeneratorService = $listGeneratorService;
    }

    public function list(TableHandleRequest $request)
    {
        $columns = $this->tableRepository->getColumns($request->table);
        $data = $this->listGeneratorService->handle($columns, $request->columns, $request->table);

        return response()->json($data);
    }

    public function form(Request $request)
    {

    }


}
