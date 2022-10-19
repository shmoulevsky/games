<?php

namespace App\Modules\Common\User\Common\Entities;

class UserStatus
{
    public const BLOCKED = 0;
    public const ACTIVE = 1;
    public const ACCEPTED = 2;
    public const NOT_CONFIRMED = 3;
    public const NOT_ACCEPTED = 4;
    const OLD_PASSWORD = 5;

    public static $statuses = [
        0 => 'blocked',
        1 => 'active',
        2 => 'accepted',
        3 => 'not confirmed',
        4 => 'not accepted',
        5 => 'old password',
    ];

    public static function get($statusId)
    {
        return self::$statuses[$statusId] ?? 'unknown';
    }

    public static function getValues()
    {
        $values = [];

        foreach (self::$statuses as $key => $status){
            $values[] = [
                'text' => $status,
                'value' => $key,
            ];
        }

        return $values;
    }
}
