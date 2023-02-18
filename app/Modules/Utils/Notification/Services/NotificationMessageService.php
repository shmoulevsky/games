<?php

namespace App\Modules\Utils\Notification\Services;

use App\Modules\Utils\Notification\Models\NotificationMessage;

class NotificationMessageService
{
    public static function store($message, $userId, $notificationId)
    {
        $notificationMessage = new NotificationMessage();
        $notificationMessage->notification_id = $notificationId;
        $notificationMessage->user_id = $userId;
        $notificationMessage->message = $message;
        $notificationMessage->save();

    }
}
