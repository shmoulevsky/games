<?php

namespace App\Modules\Game\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    public function translations()
    {
        return $this->hasMany(GameTranslation::class, 'id', 'game_id');
    }

}
