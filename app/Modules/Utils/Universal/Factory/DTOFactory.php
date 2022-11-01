<?php

namespace App\Modules\Utils\Universal\Factory;

use App\Modules\Utils\Universal\DTO\UniversalDTO;
use Illuminate\Http\Request;

class DTOFactory
{
    public static function fromRequest($validated)
    {
        return new UniversalDTO($validated);
    }

}
