<?php

namespace App\Modules\Security\DTO;

class PasswordResetVerifyDTO
{

    public $language;
    public $code;
    public $password;
    public $type;
    public $to;

    public function __construct(
        string $language,
        ?string $to,
        string $code,
        string $password,
        string $type
    )
    {
        $this->language = $language;
        $this->code = $code;
        $this->password = $password;
        $this->type = $type;
        $this->to = $to;
    }
}
