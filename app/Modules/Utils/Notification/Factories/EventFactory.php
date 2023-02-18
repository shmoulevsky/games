<?php

namespace App\Modules\Utils\Notification\Factories;


use App\Modules\Utils\Notification\Events\RegisterConfirmEvent;

class EventFactory
{
    public static function make($type)
    {
        switch ($type){
            case 1 : return new RegisterConfirmEvent();
        }

        return null;
    }
}
