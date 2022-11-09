<?php

namespace App\Modules\Common\Base\Factories;

use App\Modules\Admin\Article\Repositories\ArticleCategoryRepository;
use App\Modules\Admin\Article\Repositories\ArticleRepository;
use App\Modules\Admin\Game\Repositories\GameCategoryRepository;
use App\Modules\Admin\Page\Repositories\PageCategoryRepository;
use App\Modules\Admin\Page\Repositories\PageRepository;
use App\Modules\Common\Url\Models\Url;
use App\Modules\Pub\Game\Repositories\GameRepository;

class RepositoryFactory
{
    public static function make(string $type)
    {
        switch ($type){
            case Url::GAME : return app()->make(GameRepository::class);
            case Url::GAME_CATEGORY : return app()->make(GameCategoryRepository::class);
            case Url::ARTICLE : return app()->make(ArticleRepository::class);
            case Url::ARTICLE_CATEGORY : return app()->make(ArticleCategoryRepository::class);
            case Url::PAGE : return app()->make(PageRepository::class);
            case Url::PAGE_CATEGORY : return app()->make(PageCategoryRepository::class);
        }

        return null;
    }
}
