<?php

namespace App\Modules\Security\Requests;


use App\Modules\Base\FormBaseRequest;
use App\Modules\Utils\Validation\Entities\ValidationEntity;
use Illuminate\Validation\Rules\Password;

class RestoreVerifyRequest extends FormBaseRequest
{
    public const TYPE = ValidationEntity::RESTORE;

    public function rules(): array
    {
        return [
            'to' => ['nullable'],
            'code' => ['required', 'string'],
            'password' => ['required','string',
                Password::min(6)
                ->letters()
                ->numbers()
                ->uncompromised()
            ],
            'password_confirm' => ['required','string', 'same:password'],
            'type' => ['required','string']
        ];
    }
}
