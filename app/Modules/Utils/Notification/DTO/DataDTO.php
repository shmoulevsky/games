<?php

namespace App\Modules\Utils\Notification\DTO;

class DataDTO
{
    public $title;
    public $body;

    public function __construct($title, $body)
    {
        $this->title = $title;
        $this->body = $body;
    }
}
