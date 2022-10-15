<?php

namespace App\Modules\Security\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OldPassword extends Model
{
    use HasFactory;
    public $fillable = ['password', 'user_id'];
}
