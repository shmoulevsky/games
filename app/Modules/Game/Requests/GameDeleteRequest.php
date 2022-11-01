<?php

namespace App\Modules\Game\Requests;

use Illuminate\Http\Request;

class GameDeleteRequest
{
    public function validate(Request $request)
    {
        return $request->validate([
            'id' => 'required'
        ]);
    }
}
