<?php

namespace App\Modules\Utils\Notification\Events;


use App\Models\User;
use App\Modules\Utils\Notification\DTO\RecipientDTO;
use App\Modules\Utils\Notification\Interfaces\EventInterface;

class RegisterConfirmEvent implements EventInterface
{

    public function getRecipients($userId, $data)
    {
        $users = User::whereIn('users.id', [$userId])
            ->select([
                'users.id as id',
                'users.name as name',
                'users.lastname as lastname',
                'users.email as email',
                'users.hash as hash',
                'users.language as language',
            ])
            ->get();

        return $users->map(function ($user) use ($data){
            return RecipientDTO::fromUser($user, $data);
        });
    }

}
