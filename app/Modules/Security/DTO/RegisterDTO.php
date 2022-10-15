<?php

namespace App\Modules\Security\DTO;

class RegisterDTO
{
    public ?int $id;
    public string $name;
    public ?string $lastname;
    public string $email;
    public string $password;
    public ?string $phone;
    public $city;
    public $topics;
    public $grades;
    public $countryId;
    public $language;
    public $schoolCode;
    public $qualifications;
    public $subjects;
    public $code;
    public $affiliate;
    public $tariffPlans;

    public function __construct(
        ?int  $id,
        string  $name,
        ?string $lastname,
        string  $email,
        string  $password,
        ?string  $phone,
        int     $countryId,
        string  $language,
        ?string $city,
        ?string $code,
        ?array $schools,
        ?array  $topics,
        ?array  $grades,
        ?array  $subjects,
        ?array  $qualifications,
        ?string  $affiliate,
        ?array  $tariffPlans,
    )
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->phone = $phone;
        $this->city = $city;
        $this->schools = $schools;
        $this->topics = $topics;
        $this->grades = $grades;
        $this->countryId = $countryId;
        $this->lastname = $lastname;
        $this->language = $language;
        $this->qualifications = $qualifications;
        $this->subjects = $subjects;
        $this->code = $code;
        $this->affiliate = $affiliate;
        $this->active = 1;
        $this->sort = 100;
        $this->id = $id;
        $this->tariffPlans = $tariffPlans;
    }

}
