<?php

namespace App\Modules\Utils\Notification\Services;

use App\Modules\Utils\Notification\Repositories\NotificationRepository;
use App\Modules\Utils\Notification\Factories\ChannelFactory;
use App\Modules\Utils\Notification\Factories\EventFactory;

class EventManager
{
    /**
     * @var NotificationRepository
     */
    private $notificationRepository;

    public function __construct(NotificationRepository $notificationRepository)
    {
        $this->notificationRepository = $notificationRepository;
    }

    public function handle($eventName, $userId, $data, $isForAdmin = false)
    {
        $notifications = $this->notificationRepository->getByName($eventName);

        if($notifications->count() === 0) return;

        foreach ($notifications as $notification){
            $event = EventFactory::make($notification->notification_type_id);
            $recipients = ($event->getRecipients($userId, $data));
            $admins = [];

            if($isForAdmin){
                $admins = $event->getAdmins($notification, $data);
            }

            $channels = $notification->channels;

            foreach ($channels as $type){
                $channel = ChannelFactory::make($type);

                if($isForAdmin){
                    $channel->sendAdmin($recipients, $admins, $notification);
                    continue;
                }

                $channel->send($recipients, $admins, $notification);
            }

        }
    }

}
