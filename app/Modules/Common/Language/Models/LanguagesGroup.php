<?php

namespace App\Modules\Common\Language\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LanguagesGroup extends Model
{
    use HasFactory;
    protected $table = 'languages_group';
    public $timestamps = false;

    protected $fillable = ['name'];
}
