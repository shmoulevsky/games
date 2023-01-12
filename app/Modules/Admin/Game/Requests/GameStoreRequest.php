<?php

namespace App\Modules\Admin\Game\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class GameStoreRequest extends FormRequest
{
    public function validate(Request $request)
    {
        return $request->validate([
            'id' => 'nullable',
            'game' => 'string',
            'translations' => 'array',
        ]);
    }
}
