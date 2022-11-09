<?php

namespace App\Modules\Admin\Article\Repositories;

use App\Modules\Admin\Article\Models\ArticleTranslation;
use App\Modules\Common\Base\Repositories\BaseRepository;

class ArticleTranslationRepository extends BaseRepository
{
    protected $modelClass = ArticleTranslation::class;
}
