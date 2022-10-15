<?php

namespace App\Modules\Security\Requests;


use App\Modules\Base\FormBaseRequest;
use App\Modules\Utils\Validation\Entities\ValidationEntity;
use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormBaseRequest
{
    public const TYPE = ValidationEntity::AUTH;

    public function rules(): array
    {
        return [
            'email' => ['required', 'string'],
            'password' => ['required', 'string']
        ];
    }
}
