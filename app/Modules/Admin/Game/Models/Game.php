<?php

namespace App\Modules\Admin\Game\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    public function translations()
    {
        return $this->hasMany(GameTranslation::class, 'game_id', 'id');
    }

    public function translationsByLanguage()
    {
        return $this->hasMany(GameTranslation::class, 'game_id', 'id')->keyBy('language_id');
    }

}
