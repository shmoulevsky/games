<?php

namespace App\Modules\Security\Requests;


use App\Modules\Base\FormBaseRequest;
use App\Modules\Utils\Validation\Entities\ValidationEntity;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormBaseRequest
{
    public const TYPE = ValidationEntity::REGISTER;

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:50'],
            'lastname' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
            'password' => ['required', 'string',
                Password::min(8)
                ->letters()
                ->numbers()
                ->uncompromised()
            ],
            'schools' => ['array', 'required'],
            'schools.*.name' => ['required'],
            'schools.*.code' => ['required'],
            'phone' => ['string', 'nullable', 'max:25', 'unique:users'],
            'agree_my' => ['boolean'],
            'accept_politic' => ['boolean'],
        ];
    }
}
