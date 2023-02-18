<?php

namespace App\Modules\Utils\Notification\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationType extends Model
{
    use HasFactory;

    const INTERVAL = 'interval';
    const EVENT = 'event';
}
