<?php

namespace App\Modules\Common\User\Common\Requests;


use App\Modules\Common\Base\FormRequests\BaseFormRequest;

class UserStoreRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['nullable', 'string', 'max:50'],
            'lastname' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'string', 'email', 'max:50'],
            'phone' => ['string', 'nullable', 'max:25'],
        ];
    }
}
