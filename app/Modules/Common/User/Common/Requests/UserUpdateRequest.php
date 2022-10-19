<?php

namespace App\Modules\Common\User\Common\Requests;


use App\Modules\Common\Base\FormRequests\BaseFormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends BaseFormRequest
{

    public function rules(): array
    {
        return [
            'id' => ['require', 'int', Rule::exists('users', 'id')],
            'name' => ['nullable', 'string', 'max:50'],
            'lastname' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'string', 'email', 'max:50'],
            'phone' => ['string', 'nullable', 'max:25', Rule::unique('users')->ignore($this->id)->whereNot('phone','-')],
        ];
    }
}
