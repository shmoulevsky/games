<?php

namespace App\Modules\Admin\Property\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PropertyUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => ['required', Rule::exists('tags', 'id')],
            'translations' => ['required', 'array'],
        ];
    }
}
