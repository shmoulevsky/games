<?php

namespace App\Modules\Utils\Notification\Services;

use App\Modules\Utils\Notification\Repositories\NotificationRepository;
use App\Modules\Utils\Notification\Factories\ChannelFactory;
use App\Modules\Utils\Notification\Factories\EventFactory;

class IntrevalEventManager
{
    /**
     * @var NotificationRepository
     */
    private $notificationRepository;

    public function __construct(NotificationRepository $notificationRepository)
    {
        $this->notificationRepository = $notificationRepository;
    }

    public function handle()
    {
        $notifications = $this->notificationRepository->getInterval();
        $checkService = new NeedSendCheckerService();

        foreach ($notifications as $notification){
            $event = EventFactory::make($notification->notification_type_id);
            $recipients = $event->getRecipients($notification, []);
            $recipients = $checkService->filterRecipients($recipients, $notification);
            $admins = $this->getAdmins($notification);

            $channels = $notification->channels;

            foreach ($channels as $type){
                $channel = ChannelFactory::make($type);
                $channel->send($recipients, $admins, $notification);
            }

        }
    }

    private function getAdmins($notification)
    {
        return [];
    }
}
