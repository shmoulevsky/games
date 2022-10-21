<?php

namespace App\Modules\Utils\Generator\Http\Controllers;


use App\Modules\Utils\Generator\Repositories\TableRepository;
use Illuminate\Http\Request;

class TableController
{
    private TableRepository $tableRepository;

    public function __construct(TableRepository $tableRepository)
    {
        $this->tableRepository = $tableRepository;
    }

    public function tables(Request $request)
    {
        $tables = $this->tableRepository->getTables();
        return response()->json(['tables' => $tables]);
    }

    public function table(Request $request)
    {
        $columns = $this->tableRepository->getColumns($request->table);
        return response()->json(['columns' => $columns]);
    }


}
