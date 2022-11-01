<?php

namespace App\Modules\Utils\Generator\Http\Controllers;


use App\Modules\Utils\Generator\Repositories\SettingsRepository;
use App\Modules\Utils\Generator\Repositories\TableRepository;
use Illuminate\Http\Request;

class TableController
{
    private TableRepository $tableRepository;
    private SettingsRepository $settingsRepository;

    public function __construct(
        TableRepository $tableRepository,
        SettingsRepository $settingsRepository
    )
    {
        $this->tableRepository = $tableRepository;
        $this->settingsRepository = $settingsRepository;
    }

    public function tables(Request $request)
    {
        $tables = $this->tableRepository->getTables();
        return response()->json(['tables' => $tables]);
    }

    public function table(Request $request)
    {
        $columns = $this->tableRepository->getColumns($request->table);

        $fields = [];

        foreach ($columns as $column){
            $fields[$column->Field] = [
                'title' => ucfirst($column->Field),
                'type' => 'text',
                'is_choosen' => false,
                'value' => '',
                'er' => false,
                'message' => '',
                'list' => 1,
            ];

        }

        return response()->json(['fields' => $fields]);
    }

    public function listSettings(Request $request)
    {
        $settings = $this->settingsRepository->get($request->table, ['list']);
        return response()->json($settings);
    }


}
