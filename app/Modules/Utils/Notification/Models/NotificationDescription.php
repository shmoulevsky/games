<?php

namespace App\Modules\Utils\Notification\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationDescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'language_code',
        'notification_id',
    ];

}
