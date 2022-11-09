<?php

namespace App\Modules\Admin\Page\Repositories;

use App\Modules\Admin\Page\Models\PageCategoryTranslation;
use App\Modules\Common\Base\Repositories\BaseRepository;

class PageCategoryTranslationRepository extends BaseRepository
{
    protected $modelClass = PageCategoryTranslation::class;
}
