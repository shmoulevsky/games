<?php

namespace App\Modules\Utils\Notification\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    public $casts = [
        'channels' => 'json',
        'groups' => 'json',
        'users' => 'json'
    ];

    public function descriptions()
    {
        return $this->hasMany(NotificationDescription::class, 'notification_id', 'notification_type_id');
    }

    public function description()
    {
        return $this->hasOne(NotificationDescription::class, 'notification_id', 'id');
    }

    public function type()
    {
        return $this->hasOne(NotificationType::class, 'id', 'notification_type_id');
    }

}
