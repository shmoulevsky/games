<?php

namespace App\Modules\Common\Url\Repositories;

use App\Modules\Common\Base\Repositories\BaseRepository;
use App\Modules\Common\Url\Models\Url;
use Illuminate\Support\Facades\DB;

class UrlRepository extends BaseRepository
{
    protected $modelClass = Url::class;

    public function getByUrl(string $url)
    {
        return DB::table('urls')->where('url', $url)->first();
    }
}
