<?php

namespace App\Modules\Common\Base\DTO;

use Illuminate\Http\Request;

interface DTOInterface
{
    public function fromRequest(Request $request) : self;
}
