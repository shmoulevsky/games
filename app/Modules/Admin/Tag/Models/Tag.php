<?php

namespace App\Modules\Admin\Tag\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public function translations()
    {
        return $this->hasMany(TagTranslation::class, 'tag_id', 'id');
    }
}
