<?php

namespace App\Modules\Common\User\Register\DTO;

class RegisterDTO
{
    public ?int $id;
    public string $name;
    public ?string $lastname;
    public string $email;
    public string $password;
    public ?string $phone;

    public function __construct(
        ?int  $id,
        string  $name,
        ?string $lastname,
        string  $email,
        string  $password,
        ?string  $phone,
        int     $countryId,
        string  $language,
    )
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->phone = $phone;
        $this->countryId = $countryId;
        $this->lastname = $lastname;
        $this->language = $language;
        $this->active = 1;
        $this->sort = 100;
        $this->id = $id;
    }

}
