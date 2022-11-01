<?php

namespace App\Modules\Game\Requests;

use Illuminate\Http\Request;

class GameUpdateRequest
{
    public function validate(Request $request)
    {
        return $request->validate([
            'id' => 'required',
            'sort' => 'integer',
            'game' => 'string',
            'is_active' => 'integer',
            'thumb' => 'nullable',
            'translations' => 'array',
        ]);
    }
}
