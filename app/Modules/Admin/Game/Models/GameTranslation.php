<?php

namespace App\Modules\Admin\Game\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameTranslation extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'language_id',
        'game_id',
        'description',
        'rules',
        'seo_title',
        'seo_keywords',
        'seo_description',
        'seo_url',
    ];
}
