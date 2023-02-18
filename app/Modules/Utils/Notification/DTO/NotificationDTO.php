<?php

namespace App\Modules\Utils\Notification\DTO;

class NotificationDTO
{
    public $id;
    public $is_active;
    public $interval;
    public $frequency;
    public $delay;
    public $count;
    public $channels;
    public $typeId;
    public $descriptions;
    public $countryId;
    public $groups;

    public function __construct(
        ?int $id,
        int $is_active,
        string $interval, // Deuration class
        int $frequency, // days
        int $delay, // seconds
        int $count,
        array $channels,
        array $groups,
        string $typeId,
        array $descriptions,
        int $countryId
    ){
        $this->id = $id;

        $this->is_active = $is_active;
        $this->interval = $interval;
        $this->frequency = $frequency;
        $this->delay = $delay;
        $this->count = $count;
        $this->channels = $channels;
        $this->typeId = $typeId;
        $this->descriptions = $descriptions;
        $this->countryId = $countryId;
        $this->groups = $groups;
    }
}
