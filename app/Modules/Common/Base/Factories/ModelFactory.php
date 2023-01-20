<?php

namespace App\Modules\Common\Base\Factories;

use App\Modules\Admin\Article\Models\Article;
use App\Modules\Admin\Article\Models\ArticleCategory;
use App\Modules\Admin\Game\Models\Game;
use App\Modules\Admin\Game\Models\GameCategory;
use App\Modules\Admin\Page\Models\Page;
use App\Modules\Admin\Page\Models\PageCategory;
use App\Modules\Admin\Tag\Models\Tag;
use App\Modules\Common\Url\Models\Url;

class ModelFactory
{
    public static function make(string $type)
    {
        switch ($type){
            case Url::GAME : return app()->make(Game::class);
            case Url::GAME_CATEGORY : return app()->make(GameCategory::class);
            case Url::ARTICLE : return app()->make(Article::class);
            case Url::ARTICLE_CATEGORY : return app()->make(ArticleCategory::class);
            case Url::PAGE : return app()->make(Page::class);
            case Url::PAGE_CATEGORY : return app()->make(PageCategory::class);
            case Url::TAG : return app()->make(Tag::class);
        }

        return null;
    }
}
