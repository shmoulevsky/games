<?php

namespace App\Modules\Admin\Article\Repositories;

use App\Modules\Admin\Article\Models\Article;
use App\Modules\Common\Base\Repositories\BaseRepository;

class ArticleRepository extends BaseRepository
{
    protected $modelClass = Article::class;
}
