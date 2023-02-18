<?php

namespace App\Modules\Email\Requests;

use App\Modules\Base\FormBaseRequest;
use App\Modules\Email\Entities\EmailCodes;
use App\Modules\Utils\Validation\Entities\ValidationEntity;
use Illuminate\Validation\Rule;

class EmailUpdateRequest extends  FormBaseRequest
{
    public const TYPE = ValidationEntity::EMAIL;

    public function rules(): array
    {
        return [
            'id' => ['required', Rule::exists('emails', 'id')],
            'code' => ['required', Rule::in(EmailCodes::get())],
            'templates' => ['required', 'array'],
            'templates.*.title' => ['required', 'string'],
            'templates.*.template' => ['required', 'string'],
        ];
    }
}
