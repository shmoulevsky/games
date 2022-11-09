<?php

namespace App\Modules\Admin\Page\Repositories;

use App\Modules\Admin\Page\Models\PageTranslation;
use App\Modules\Common\Base\Repositories\BaseRepository;

class PageTranslationRepository extends BaseRepository
{
    protected $modelClass = PageTranslation::class;
}
