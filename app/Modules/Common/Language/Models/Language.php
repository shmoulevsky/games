<?php

namespace App\Modules\Common\Language\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['name', 'code', 'dir', 'status'];

    public function values()
    {
        return $this->hasMany(LanguagesValues::class, 'language_id', 'id');
    }
}
