<?php

namespace App\Modules\Common\Property\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyTranslation extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $fillable = ['title', 'property_id', 'language_id'];
}
