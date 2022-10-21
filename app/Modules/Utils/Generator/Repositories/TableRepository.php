<?php

namespace App\Modules\Utils\Generator\Repositories;

use Illuminate\Support\Facades\DB;

class TableRepository
{
    public function getTables(){
        $tables = DB::select('SHOW TABLES');
        $db = "Tables_in_".env('DB_DATABASE');

        return array_column($tables, $db);

    }

    public function getColumns(string $table){
        return DB::select( DB::raw('SHOW COLUMNS FROM `'.$table.'`'));
    }
}
