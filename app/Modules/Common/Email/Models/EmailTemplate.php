<?php

namespace App\Modules\Email\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    use HasFactory;

    protected $table = 'email_templates';
    public $timestamps = false;

    protected $fillable = [
        'language_code',
        'template',
        'title',
    ];
}
