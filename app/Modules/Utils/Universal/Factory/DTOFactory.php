<?php

namespace App\Modules\Utils\Universal\Factory;

use App\Modules\Utils\Universal\DTO\UniversalDTO;
use Illuminate\Http\Request;

class DTOFactory
{
    public static function fromRequest(Request $request)
    {
        $validated = $request->validate([
            'id' => 'nullable',
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'password' => 'required',
            'group_id' => 'required',
            'access_panel' => 'required',
            'language' => 'required',
            'status' => 'required',
        ]);

        return new UniversalDTO($validated);
    }

}
