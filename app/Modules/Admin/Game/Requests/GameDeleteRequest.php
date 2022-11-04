<?php

namespace App\Modules\Admin\Game\Requests;

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
