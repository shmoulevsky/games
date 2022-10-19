<?php

namespace App\Modules\Common\User\Common\Requests;



use App\Modules\Common\Base\FormRequests\BaseFormRequest;

class UserPhotoRequest extends BaseFormRequest
{

    public function rules(): array
    {
        return [
            'img' => ['required', 'image', 'mimes:jpg,jpeg,png,bmp,gif','max:5000'],
        ];
    }
}
