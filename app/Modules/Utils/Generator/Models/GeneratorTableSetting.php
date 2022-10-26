<?php

namespace App\Modules\Utils\Generator\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneratorTableSetting extends Model
{
    use HasFactory;

    protected $casts = [
        'list' => 'json',
        'form' => 'json',
    ];
}
