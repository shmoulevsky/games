<?php

namespace App\Modules\Utils\Notification\Repositories;


use App\Modules\Common\Base\Repositories\BaseRepository;
use App\Modules\Utils\Notification\Models\NotificationDescription;

class NotificationDescriptionRepository extends BaseRepository
{
    protected $modelClass = NotificationDescription::class;

    public function find(string $languageCode, int $notificationId)
    {
        return $this->model->where([
            ['language_code', $languageCode],
            ['notification_id', $notificationId],
        ])->first();
    }
}
