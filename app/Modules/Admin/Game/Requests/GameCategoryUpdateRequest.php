<?php

namespace App\Modules\Admin\Game\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GameCategoryUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => ['required', Rule::exists('game_categories', 'id')],
            'translations' => ['required', 'array'],
        ];
    }
}
