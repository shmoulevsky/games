<?php

namespace App\Modules\Utils\Notification\Services;

use App\Modules\Utils\Notification\Models\NotificationMessage;
use Illuminate\Support\Carbon;

class NeedSendCheckerService
{
    public function isNeedSend($user, $notification)
    {

        $countMessages = NotificationMessage::where([
            ['notification_id', $notification->id],
            ['user_id', $user->id],
        ])->count();

        if($countMessages >= $notification->count){
            return false;
        }

        $lastMessage = NotificationMessage::select(['id','created_at'])->where([
            ['notification_id', $notification->id],
            ['user_id', $user->id],
        ])->orderBy('id', 'desc')->first();

        if(empty($lastMessage)) return true;

        $nextDate = $lastMessage->created_at->addDays($notification->frequency);

        if($nextDate->gte(Carbon::now())) return false;

        return true;
    }

    public function filterRecipients($recipients, $notification)
    {
        return $recipients->filter(function ($recipient) use ($notification){
            return $this->isNeedSend($recipient, $notification);
        });
    }
}
