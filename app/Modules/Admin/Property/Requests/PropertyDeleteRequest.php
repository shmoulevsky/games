<?php

namespace App\Modules\Admin\Property\Requests;

use Illuminate\Http\Request;

class PropertyDeleteRequest
{
    public function validate(Request $request)
    {
        return $request->validate([
            'id' => 'required'
        ]);
    }
}
