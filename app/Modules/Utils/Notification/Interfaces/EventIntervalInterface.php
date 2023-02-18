<?php

namespace App\Modules\Utils\Notification\Interfaces;

interface EventIntervalInterface
{
    public function getRecipients($notification, $data);
}
