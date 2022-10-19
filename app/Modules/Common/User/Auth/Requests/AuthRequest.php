<?php

namespace App\Modules\Common\User\Auth\Requests;


use App\Modules\Common\Base\FormRequests\BaseFormRequest;

class AuthRequest extends BaseFormRequest
{

    public function rules(): array
    {
        return [
            'email' => ['required', 'string'],
            'password' => ['required', 'string']
        ];
    }
}
