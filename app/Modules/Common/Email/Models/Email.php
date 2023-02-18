<?php

namespace App\Modules\Email\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;

    protected $table = 'emails';
    public $timestamps = false;

    protected $fillable = [
        'variables',
    ];

    public function template()
    {
        return $this->hasOne(EmailTemplate::class, 'email_id', 'id');
    }

    public function templates()
    {
        return $this->hasMany(EmailTemplate::class, 'email_id', 'id');
    }
}
