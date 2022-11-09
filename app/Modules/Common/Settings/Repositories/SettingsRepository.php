<?php

namespace App\Modules\Common\Settings\Repositories;

use App\Modules\Common\Base\Repositories\BaseRepository;
use App\Modules\Common\Settings\Models\Settings;
use Illuminate\Support\Facades\DB;

class SettingsRepository extends BaseRepository
{
    protected $modelClass = Settings::class;

    public function getByGroup($group)
    {
        return DB::table('settings')
            ->where('group', $group)
            ->get()
            ->keyBy('key');
    }

}
