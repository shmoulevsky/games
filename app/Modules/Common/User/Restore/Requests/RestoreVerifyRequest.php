<?php

namespace App\Modules\Common\User\Restore\Requests;


use App\Modules\Common\Base\FormRequests\BaseFormRequest;
use Illuminate\Validation\Rules\Password;

class RestoreVerifyRequest extends BaseFormRequest
{

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
