<?php

namespace App\Modules\Pub\OAuth\DTO;

class OAuthResult
{
    public function __construct(
        public ?string $name,
        public ?string $lastName,
        public ?string $email,
        public ?string $phone,
        public ?string $photo,
        public ?string $birthday,
        public ?int $sex,
        public ?string $country,
        public ?string $city,
        public ?string $type,
        public ?string $id,

    )
    {
    }
}
