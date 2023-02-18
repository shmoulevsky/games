<?php

namespace App\Modules\Utils\Notification\DTO;

class RecipientDTO
{
    public $id;
    public $name;
    public $lastName;
    public $email;
    public $phone;
    public $additional;
    public $language;
    public $status;

    public function __construct(
        $id,
        $name,
        $lastName,
        $email,
        $phone,
        $language,
        $status,
        $additional
    )
    {

        $this->id = $id;
        $this->name = $name;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phone = $phone;
        $this->additional = $additional;
        $this->language = $language;
        $this->status = $status;
    }

    public static function fromUser($user, $additionalInfo)
    {
        return new self(
            $user->id,
            $user->name,
            $user->lastname,
            $user->email,
            $user->phone,
            $user->language,
            $user->status,
            $additionalInfo,
        );
    }

}
