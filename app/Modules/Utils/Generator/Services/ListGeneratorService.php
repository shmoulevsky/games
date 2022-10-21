<?php

namespace App\Modules\Utils\Generator\Services;
use stdClass;

class ListGeneratorService
{
    public function handle($columns, $needColumns, $tableName, $perPage = 10){

        $data = [
            "title" => "trans('{$tableName} list')",
            "per_page" => $perPage,
            "items" => [],
        ];

        $dir = "desc";
        $isSort = true;

        foreach ($columns as $column){

            if(!in_array($column->Field ,$needColumns)) continue;

            $title = str_ireplace('_',' ',ucfirst($column->Field));
            $data["columns"][] = $column->Field;
            $data["headers"][] = [
                "title" => "trans('{$title}')",
                "code" => $column->Field,
                "dir" => $dir,
                "is_sort" => $isSort,
            ];
            $dir = "asc";
            $isSort = false;

        }

        return $data;

    }
}
