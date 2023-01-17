<?php

namespace App\Modules\Admin\Game\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class GameCategory extends Model
{
    use HasFactory, NodeTrait;

    public function translations()
    {
        return $this->hasMany(GameCategoryTranslation::class, 'game_category_id', 'id');
    }
}
