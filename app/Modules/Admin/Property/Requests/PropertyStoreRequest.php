<?php

namespace App\Modules\Admin\Property\Requests;


use Illuminate\Foundation\Http\FormRequest;

class PropertyStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => ['nullable'],
            'translations' => ['required', 'array'],
        ];
    }
}
