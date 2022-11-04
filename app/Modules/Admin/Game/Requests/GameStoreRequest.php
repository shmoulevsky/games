<?php

namespace App\Modules\Admin\Game\Requests;

use Illuminate\Http\Request;

class GameStoreRequest
{
    public function validate(Request $request)
    {
        return $request->validate([
            'id' => 'nullable',
            'sort' => 'integer',
            'game' => 'string',
            'is_active' => 'integer',
            'thumb' => 'nullable',
            'translations' => 'array',
        ]);
    }
}
