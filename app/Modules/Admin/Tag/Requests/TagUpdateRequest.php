<?php

namespace App\Modules\Admin\Tag\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TagUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => ['required', Rule::exists('tags', 'id')],
            'game' => ['required', 'string'],
            'translations' => ['required', 'array'],
        ];
    }
}
