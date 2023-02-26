<?php

namespace App\Modules\Admin\Tag\Requests;


use Illuminate\Foundation\Http\FormRequest;

class TagStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => ['nullable'],
            'game' => ['required', 'string'],
            'translations' => ['required', 'array'],
        ];
    }
}
