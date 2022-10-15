<?php

namespace App\Modules\Security\DTO;

class PasswordResetDTO
{
    public $language;
    public $to;
    public $type;

    public function __construct(
        string $language,
        ?string $to,
        string $type
    )
    {
        $this->language = $language;
        $this->to = $to;
        $this->type = $type;
    }
}
