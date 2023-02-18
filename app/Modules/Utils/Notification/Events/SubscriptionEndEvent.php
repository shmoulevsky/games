<?php

namespace App\Modules\Utils\Notification\Events;

use App\Models\User;
use App\Modules\Utils\Notification\DTO\RecipientDTO;
use App\Modules\Utils\Notification\Interfaces\EventIntervalInterface;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class SubscriptionEndEvent implements EventIntervalInterface
{
    public function __construct()
    {

    }

    public function getRecipients($notification, $data)
    {
        $from = Carbon::now()->subWeek();
        $to = Duration::calcDurationDate($notification->interval);
        $userIds = UserSubscription::select('user_id as id')
            ->where([
                ['till','>=', $from],
                ['till','<=', $to],
            ])
            ->get();

        $users = User::whereIn('users.id', $userIds)
            ->select([
                'users.id as id',
                'users.name as name',
                'users.lastname as lastname',
                'users.email as email',
                'users.phone as phone',
                'users.city_id as city_id',
                'users.status as status',
                'users.language as language',
                'user_subscriptions.id as period_id',
                'user_subscriptions.from as from',
                'user_subscriptions.till as till',
                'user_subscriptions.school_id as school_id',
            ])
            ->leftJoin('user_subscriptions', function ($query) use ($from, $to){
                $query->on('user_subscriptions.user_id','=', 'users.id');
                $query->on('user_subscriptions.till','>=', DB::raw('"'.$from.'"'));
                $query->on('user_subscriptions.till','<=', DB::raw('"'.$to.'"'));
            })
            ->get();



        return $users->map(function ($user){

            return RecipientDTO::fromUser($user,
                [
                    'till' => $user->till,
                    'link' => '//origametria.com/prolong/'.$user->hash,
                ],
            );
        });

    }

}
