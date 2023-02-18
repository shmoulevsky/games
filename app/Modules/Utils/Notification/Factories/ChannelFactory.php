<?php

namespace App\Modules\Utils\Notification\Factories;

use App\Modules\Utils\Notification\Channels\EmailChannel;
use App\Modules\Utils\Notification\Services\TemplateService;

class ChannelFactory
{
    public static function make($type)
    {
        $templateService = new TemplateService();

        switch ($type){
            case "App\Modules\Utils\Notification\Services\Channels\EmailChannel" : return new EmailChannel($templateService);
        }

        return null;
    }
}
