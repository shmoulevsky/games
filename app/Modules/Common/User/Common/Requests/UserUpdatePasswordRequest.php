<?php

namespace App\Modules\Common\User\Common\Requests;

use App\Modules\Common\Base\FormRequests\BaseFormRequest;
use Illuminate\Support\Facades\Password;

class UserUpdatePasswordRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'password' => ['required', 'string',
                Password::min(6)
                ->letters()
                ->numbers()
                ->uncompromised()
            ],
        ];
    }
}
