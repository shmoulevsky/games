<?php

namespace App\Modules\Utils\Notification\Repositories;

use App\Modules\Common\Base\Repositories\BaseRepository;
use App\Modules\Utils\Notification\Models\Notification;
use App\Modules\Utils\Notification\Models\NotificationType;
use Illuminate\Support\Facades\DB;


class NotificationRepository extends BaseRepository
{
    protected $modelClass = Notification::class;

    public function all($column = 'id', $dir = 'desc')
    {
        return $this->model
            ->select(
                'notifications.*',
                'notification_descriptions.name as name'
            )
            ->join('notification_descriptions', function ($query) {
                $query->on('notification_descriptions.notification_id','=', 'notifications.id');
                $query->where('notification_descriptions.language_code','=', $this->currentLanguage);
            })
            ->orderBy($column, $dir)
            ->get();
    }

    public function getInterval()
    {
        return $this->model
            ->select(
                'notifications.*',
                'notification_types.handler as handler',
                'notification_types.groups as groups',
                'notification_types.variables as variables',
            )
            ->join('notification_types', function ($query) {
                $query->on('notification_types.id','=', 'notifications.notification_type_id');
                $query->on('notification_types.type','=', DB::raw("'".NotificationType::INTERVAL."'"));
            })->with('descriptions:name,description,language_code,notification_id')
            ->where('is_active', 1)
            ->get();
    }

    public function getByName(string $name)
    {
        return $this->model
            ->select(
                'notifications.*',
                'notification_types.handler as handler',
                'notification_types.groups as groups',
                'notification_types.variables as variables',
            )
            ->join('notification_types', function ($query) use ($name) {
                $query->on('notification_types.id','=', 'notifications.notification_type_id');
                $query->on('notification_types.name','=', DB::raw("'".$name."'"));
            })
            ->where('notifications.is_active', 1)
            ->get();
    }


}


