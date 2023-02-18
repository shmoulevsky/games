<?php

namespace App\Modules\Email\Entities;

class EmailCodes
{
    public static function get()
    {
        return [
            'registration.new',
            'registration.confirm',
            'auth.change_password',
        ];
    }
}
