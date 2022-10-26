<?php

namespace App\Modules\Utils\Generator\Services;

use App\Modules\Utils\Generator\DTO\GeneratorTableSettingDTO;
use App\Modules\Utils\Generator\Models\GeneratorTableSetting;

class GeneratorTableSettingService
{
    public function createOrUpdate(GeneratorTableSettingDTO $dto)
    {
        $setting = GeneratorTableSetting::where('table', $dto->table)->first();

        if ($setting == null) {
            $setting = new GeneratorTableSetting();
        }

        $setting->table = $dto->table;
        $setting->list = $dto->list;
        $setting->form = $dto->form;
        $setting->save();

    }
}
