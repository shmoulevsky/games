<?php

namespace App\Modules\Admin\Game\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameCategoryTranslation extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'language_id',
        'game_category_id',
        'description',
        'sort',
        'is_active',
        'seo_title',
        'seo_keywords',
        'seo_description',
        'seo_url',
    ];
}
