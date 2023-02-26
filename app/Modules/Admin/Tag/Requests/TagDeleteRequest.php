<?php

namespace App\Modules\Admin\Tag\Requests;

use Illuminate\Http\Request;

class TagDeleteRequest
{
    public function validate(Request $request)
    {
        return $request->validate([
            'id' => 'required'
        ]);
    }
}
