<?php

namespace App\Modules\Security\Requests;


use App\Modules\Base\FormBaseRequest;
use App\Modules\Utils\Validation\Entities\ValidationEntity;
use Illuminate\Foundation\Http\FormRequest;

class RestoreSendRequest extends FormBaseRequest
{
    public const TYPE = ValidationEntity::RESTORE;

    public function rules(): array
    {
        return [
            'to' => ['required', 'string'],
            'type' => ['required','string']
        ];
    }
}
