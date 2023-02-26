<?php

namespace App\Modules\Common\User\Register\Requests;


use App\Modules\Common\Base\FormRequests\BaseFormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class RegisterQuickRequest extends BaseFormRequest
{

    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
            'password' => ['required', 'string',
                /*Password::min(6)
                ->letters()
                ->numbers()
                ->uncompromised()*/
            ],
            'agree' => ['required', Rule::in('true')],
        ];
    }
}
