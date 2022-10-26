<?php

namespace App\Modules\Utils\Generator\Repositories;

use App\Modules\Utils\Generator\Models\GeneratorTableSetting;
use Illuminate\Support\Facades\DB;

class SettingsRepository
{
    public function get(string $table, array $select){
        return GeneratorTableSetting::select($select)
            ->where('table', $table)
            ->first();
    }
}
