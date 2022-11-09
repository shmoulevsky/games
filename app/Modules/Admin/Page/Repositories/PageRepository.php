<?php

namespace App\Modules\Admin\Page\Repositories;

use App\Modules\Admin\Page\Models\Page;
use App\Modules\Common\Base\Repositories\BaseRepository;

class PageRepository extends BaseRepository
{
    protected $modelClass = Page::class;
}
