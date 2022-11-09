<?php

namespace App\Modules\Admin\Article\Repositories;

use App\Modules\Admin\Article\Models\ArticleCategory;
use App\Modules\Common\Base\Repositories\BaseRepository;

class ArticleCategoryRepository extends BaseRepository
{
    protected $modelClass = ArticleCategory::class;
}
