<?php

namespace App\Modules\Admin\Game\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GameUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => ['required', Rule::exists('games', 'id')],
            'game' => ['required', 'string'],
            'translations' => ['required', 'array'],
        ];
    }
}
