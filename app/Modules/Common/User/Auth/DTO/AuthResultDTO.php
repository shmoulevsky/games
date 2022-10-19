<?php

namespace App\Modules\Common\User\Auth\DTO;

use App\Models\User;

class AuthResultDTO
{
    public ?string $email;
    private ?User $user;
    private ?string $token;
    private ?array $group;

    public function __construct(?User $user, string $token, array $group)
    {
        $this->user = $user;
        $this->token = $token;
        $this->group = $group;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }


    public function getGroup(): ?array
    {
        return $this->group;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }
}
