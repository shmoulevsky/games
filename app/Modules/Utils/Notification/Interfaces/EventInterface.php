<?php

namespace App\Modules\Utils\Notification\Interfaces;

interface EventInterface
{
    public function getRecipients($userId, $data);
}
