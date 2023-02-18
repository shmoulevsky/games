<?php

namespace App\Modules\Email\Requests;

use App\Modules\Base\FormBaseRequest;
use App\Modules\Utils\Validation\Entities\ValidationEntity;
use Illuminate\Foundation\Http\FormRequest;


class EmailStoreRequest extends  FormBaseRequest
{
    public const TYPE = ValidationEntity::EMAIL;

    public function rules(): array
    {
        return [
            'code' => ['string', 'nullable'],
            'variables' => ['string', 'required'],
            'templates' => ['required', 'array'],
            'templates.*.title' => ['required', 'string'],
            'templates.*.template' => ['required', 'string'],
        ];
    }
}
