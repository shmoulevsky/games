<?php

namespace App\Modules\Common\User\Restore\Requests;


use App\Modules\Common\Base\FormRequests\BaseFormRequest;

class RestoreSendRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'to' => ['required', 'string'],
            'type' => ['required','string']
        ];
    }
}
