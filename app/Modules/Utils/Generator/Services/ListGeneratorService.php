<?php

namespace App\Modules\Utils\Generator\Services;
use stdClass;

class ListGeneratorService
{
    public function handle($columns, $tableName, $perPage = 10)
    {

        $data = [
            "title" => "{$tableName} list",
            "per_page" => $perPage,
            "items" => [],
        ];


        $dir = "desc";
        $isSort = true;

        foreach ($columns as $column){


            $title = $column["title"];
            $data["columns"][] = $column['code'];
            $data["headers"][] = [
                "title" => $title,
                "code" => $column['code'],
                "dir" => $dir,
                "is_sort" => $isSort,
            ];
            $dir = "asc";
            $isSort = false;

        }

        return $data;

    }
}
