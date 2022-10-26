<?php

namespace App\Modules\Utils\Universal\DTO;

use Illuminate\Http\Request;

class UniversalDTO
{
    public function __construct($validated)
    {
        foreach ($validated as $key => $value){
            $this->{$key} = $value;
        }
    }

    public function toArray()
    {
        $data = [];

        foreach ($this as $key => $value){
            $data[$key] = $value;
        }

        return $data;
    }
}
