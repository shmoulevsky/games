<?php

namespace App\Modules\Admin\Game\Requests;


use Illuminate\Foundation\Http\FormRequest;

class GameCategoryStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => ['nullable'],
            'translations' => ['required', 'array'],
        ];
    }
}
