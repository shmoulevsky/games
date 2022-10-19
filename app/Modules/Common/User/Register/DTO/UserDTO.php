<?php

namespace App\Modules\Common\User\Register\DTO;

use App\Modules\Common\Base\DTO\DTOInterface;
use Illuminate\Http\Request;


class UserDTO implements DTOInterface
{
    public $name;
    public $lastname;
    public $email;
    public $password;
    public $phone;
    public $city;
    public $countryId;
    public $language;
    public $id;
    public $code;
    public $status;

    public function __construct(
        int  $id,
        ?string  $name,
        ?string $lastname,
        ?string  $email,
        ?string  $password,
        ?string  $phone,
        int     $countryId,
        string  $language,
        ?int  $status,
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->phone = $phone;
        $this->countryId = $countryId;
        $this->lastname = $lastname;
        $this->language = $language;
        $this->status = $status;
    }

    public function fromRequest(Request $request): DTOInterface
    {
        return new self(
            $request->id,
            $request->name,
            $request->lastname,
            $request->email,
            $request->password,
            $request->phone,
            $request->countryId,
            $request->language,
            $request->status,
        );
    }
}
