<?php

namespace App\Modules\Security\DTO;

use App\Models\User;
use App\Modules\Security\Resources\AuthUserResource;

class UserDTO
{
    public string $email;
    private User $user;
    private string $token;
    private array $group;

    public function __construct(?User $user, string $token, array $group)
    {
        $this->user = $user;
        $this->token = $token;
        $this->group = $group;
    }

    /**
     * @return mixed|string
     */
    public function getUser()
    {
        return new AuthUserResource($this->user);
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @return array
     */
    public function getGroup(): array
    {
        return $this->group;
    }
}
