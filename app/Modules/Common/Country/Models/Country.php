<?php

namespace App\Modules\Common\Country\Models;

use Google\Service\Dfareporting\Resource\Languages;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $casts = [
        'oauth' => 'json'
    ];

    public function languages()
    {
        return $this->belongsToMany(Languages::class, 'countries_languages', 'country_id', 'language_id');
    }

}
