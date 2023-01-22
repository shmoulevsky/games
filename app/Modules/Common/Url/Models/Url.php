<?php

namespace App\Modules\Common\Url\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    public const GAME = 'game';
    public const GAME_CATEGORY = 'game_category';
    public const PAGE = 'page';
    public const PAGE_CATEGORY = 'page_category';
    public const ARTICLE = 'article';
    public const ARTICLE_CATEGORY = 'article_category';
    public const TAG = 'tag';
    public const NOT_FOUND = 'not_found';

    use HasFactory;
    protected $fillable = ['url', 'entity', 'entity_id', 'list', 'language_id'];
    protected $casts = ['list' => 'json'];


}
