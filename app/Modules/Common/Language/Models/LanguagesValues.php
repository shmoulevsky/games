<?php

namespace App\Modules\Common\Language\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LanguagesValues extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['language_id', 'code', 'translation', 'group'];
}
