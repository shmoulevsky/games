<?php

namespace App\Modules\Admin\Article\Repositories;

use App\Modules\Admin\Article\Models\ArticleCategoryTranslation;
use App\Modules\Common\Base\Repositories\BaseRepository;

class ArticleCategoryTranslationRepository extends BaseRepository
{
    protected $modelClass = ArticleCategoryTranslation::class;
}
