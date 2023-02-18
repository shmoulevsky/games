<?php

namespace App\Modules\Utils\Notification\Interfaces;

interface ChannelInterface
{
    public function send($recipients, $admins, $notification);
}
