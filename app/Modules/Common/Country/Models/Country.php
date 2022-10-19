<?php

namespace App\Modules\Common\Country\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    public function languages()
    {
        return $this->belongsToMany(Languages::class, 'countries_languages', 'country_id', 'language_id');
    }

}
