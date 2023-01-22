<?php

namespace App\Modules\Common\Settings\Services;

use App\Modules\Common\Settings\Models\Settings;

class SettingsService
{

    public function updateByKey($key, $item)
    {
        $settings = Settings::where('key', $key)->first();
        $settings->json = json_encode($item);
        $settings->save();
        return $settings;
    }
}
