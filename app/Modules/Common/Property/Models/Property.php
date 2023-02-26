<?php

namespace App\Modules\Common\Property\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function translations()
    {
        return $this->hasMany(PropertyTranslation::class, 'property_id', 'id');
    }

}
