<?php

namespace App\Modules\Common\User\Common\Requests;


use App\Modules\Common\Base\FormRequests\BaseFormRequest;
use App\Modules\Common\User\Requests\Rule;
use Illuminate\Support\Facades\Auth;

class UserUpdateProfileRequest extends BaseFormRequest
{

    public function rules(): array
    {
        $id = Auth::user()->id;

        return [
            'name' => ['nullable', 'string', 'max:50'],
            'lastname' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'string', 'email', 'max:50', Rule::unique('users')->ignore($id)],
            'phone' => ['string', 'nullable', 'max:25', Rule::unique('users')->ignore($id)],
        ];
    }
}
