<?php

namespace App\Modules\Admin\Page\Repositories;

use App\Modules\Admin\Page\Models\PageCategory;
use App\Modules\Common\Base\Repositories\BaseRepository;

class PageCategoryRepository extends BaseRepository
{
    protected $modelClass = PageCategory::class;
}
